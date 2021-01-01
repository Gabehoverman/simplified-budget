const monthNames = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];
const date = new Date();
const month = monthNames[date.getMonth()];

var budgetMethods = {
    getMonthlyBudgetAmount ( budget ) {
        return budget.monthly_budgets[ month ]
    }
}

export default Object.freeze(budgetMethods)
