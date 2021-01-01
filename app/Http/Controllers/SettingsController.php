<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('notifications');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['intent'] = \Auth::User()->createSetupIntent();
        $data['user'] = \Auth::User();
        $data['user']->bill_date = $data['user']->getBillDate();
        $data['user']->invoices = $data['user']->getInvoices();
        $data['user']->on_trial = \Carbon\Carbon::parse($data['user']->trial_ends_at) > \Carbon\Carbon::now();

        return view('user.settings', $data);
    }

    public function updateProfile( Request $request)
    {
        try {
            $user = \Auth::User();
            $user->update( $request->input() );
            $user->save();
            $user->bill_date = $user->getBillDate();
            $user->invoices = $user->getInvoices();
            $user->on_trial = \Carbon\Carbon::parse($user->trial_ends_at) > \Carbon\Carbon::now();

            return response( json_encode($user), 200 );
        } catch (\Exception $e) {
            return response( json_encode( $e->getMessage() ), 500);
        }
    }


    /**
     * BILLING METHODS
    */
    public function attachCard( Request $request)
    {
        try {
            $payment_method = $request->input('payment_method');

            $user = \Auth::User();
            $user->updateDefaultPaymentMethod( $payment_method );

            //todo: check if user is subscribed to a plan, and attach to plan when they enter card
            if (!$user->subscribed('subscription')) {
                if ( \Carbon\Carbon::parse($user->trial_ends_at) > \Carbon\Carbon::now() ) {
                    $user->newSubscription( 'subscription', $user->getSubscriptionByPlan() )
                            ->trialUntil( \Carbon\Carbon::parse( $user->trial_ends_at ) )
                            ->create( $user->defaultPaymentMethod()->id );
                } else {
                    $user->newSubscription( 'subscription', $user->getSubscriptionByPlan() )
                            ->create( $user->defaultPaymentMethod()->id );
                }
            }

            $user->bill_date = $user->getBillDate();
            $user->invoices = $user->getInvoices();
            $user->on_trial = \Carbon\Carbon::parse($user->trial_ends_at) > \Carbon\Carbon::now();

            return response( json_encode($user), 200 );
        } catch (\Exception $e) {
            return response( json_encode( $e->getMessage() ), 500);
        }
    }

    public function changePlan( Request $request )
    {
        try {
            $user = \Auth::User();

            if ($request->input('plan') == 'Free') {
                if ( $user->subscription('subscription') ) {
                    $user->subscription('subscription')->cancel();
                }
                $user->plan = $request->input('plan');
            } else if (\Carbon\Carbon::parse($user->trial_ends_at) > \Carbon\Carbon::now()) {
                // user on free trial still, switch freely
                $user->plan = $request->input('plan');
            } else {
                if (!$user->subscribed('subscription')) {
                    $user->newSubscription( 'subscription', $request->input('subscription') )->create( $user->defaultPaymentMethod()->id );
                    $user->plan = $request->input('plan');
                } else {
                    $user->subscription( 'subscription' )->swap( $request->input('subscription') );
                    $user->plan = $request->input('plan');
                }
            }
            $user->save();

            $user->bill_date = $user->getBillDate();
            $user->invoices = $user->getInvoices();
            $user->on_trial = \Carbon\Carbon::parse($user->trial_ends_at) > \Carbon\Carbon::now();

            return response( json_encode($user), 200 );
        } catch (\Exception $e) {
            return response( json_encode( $e->getMessage() ), 500);
        }
    }

    public function billingPortal(Request $request)
    {
        return \Auth::User()->redirectToBillingPortal();
    }
}
