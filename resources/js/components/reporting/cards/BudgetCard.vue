<template>
    <div class="card">
        <div class="card-header col-12">
            <h3>Budget</h3>
        </div>
        <div class="card-body">
            <div class="col">

                <div class="row align-items-center no-gutters">
                    <div class="col-12">

                        <!-- Progress -->
                        <div class="progress progress-md">
                            <div class="progress-bar" role="progressbar" style="width: 23%" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 mt-5 row">
                        <div class="col-4">
                            <h5><span class="text-primary">●</span> $12</h5> Spent
                        </div>
                        <div class="col-4">
                            <h5><span class="text-info">●</span> $875</h5> Upcoming
                        </div>
                        <div class="col-4">
                            <h5><span style="color: #edf2f9">●</span> $2,265</h5> Remaining
                        </div>
                    </div>

                </div>
            </div> <!-- / .row -->

        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
