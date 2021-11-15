<template>
    <div>
        <TemplateA title="DashBoard">
            <template #body>
                <div class="col col-12">
                    <div class="row">
                        <!-- <div class="col-md-6 col-lg-4 col-12"> -->
                        <div class="col-md-6 col-lg-3 col-12">
                            <div
                                class="v-card--material mt-4 v-card--material-stats v-card v-sheet theme--light"
                                color="#FD9A13"
                                icon="mdi-sofa-single"
                                title="Student"
                            >
                                <div class="v-card__title align-start">
                                    <div
                                        class="overflow-hidden mt-n9 transition-swing v-card--material__sheet v-sheet theme--light elevation-6 rounded"
                                        style="max-width: 100%; background-color: rgb(253, 154, 19); border-color: rgb(253, 154, 19);"
                                    >
                                        <div class="pa-8">
                                            <i
                                                aria-hidden="true"
                                                class="v-icon notranslate mdi mdi-sofa-single theme--dark"
                                                style="font-size: 36px;"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="text-h4 v-card--material__title pl-3"
                                    >
                                        <!-- {{ $t("dashboard.student") }} -->
                                        <div class="text-subtitle-1 mb-n4">
                                            <div
                                                class="text-right text-h3 v-card__subtitle--material-stats"
                                            >
                                                <!-- {{
                                                    dashboard.number_of_students
                                                }} -->
                                                Student
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <hr
                                    role="separator"
                                    aria-orientation="horizontal"
                                    class="mt-2 mx-4 v-divider theme--light"
                                />
                                <div
                                    class="v-card__actions px-4 text-caption grey--text"
                                >
                                    <i
                                        aria-hidden="true"
                                        class="v-icon notranslate mr-2 mdi mdi-alert theme--light"
                                        style="font-size: 16px;"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-12">
                            <div
                                class="v-card--material mt-4 v-card--material-stats v-card v-sheet theme--light"
                                color="#FD9A13"
                                icon="mdi-sofa-single"
                                title="Bookings"
                            >
                                <div class="v-card__title align-start">
                                    <div
                                        class="overflow-hidden mt-n9 transition-swing v-card--material__sheet v-sheet theme--light elevation-6 rounded"
                                        style="max-width: 100%; background-color: rgb(253, 154, 19); border-color: rgb(253, 154, 19);"
                                    >
                                        <div class="pa-8">
                                            <i
                                                aria-hidden="true"
                                                class="v-icon notranslate mdi mdi-sofa-single theme--dark"
                                                style="font-size: 36px;"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="text-h4 v-card--material__title pl-3"
                                    >
                                        <!-- {{ $t("dashboard.product") }} -->

                                        <div class="text-subtitle-1 mb-n4">
                                            <div
                                                class="text-right text-h3 v-card__subtitle--material-stats"
                                            >
                                                Product
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <hr
                                    role="separator"
                                    aria-orientation="horizontal"
                                    class="mt-2 mx-4 v-divider theme--light"
                                />
                                <div
                                    class="v-card__actions px-4 text-caption grey--text"
                                >
                                    <i
                                        aria-hidden="true"
                                        class="v-icon notranslate mr-2 mdi mdi-alert theme--light"
                                        style="font-size: 16px;"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-12">
                            <div
                                class="v-card--material mt-4 v-card--material-stats v-card v-sheet theme--light"
                                color="#FD9A13"
                                icon="mdi-sofa-single"
                                title="Bookings"
                            >
                                <div class="v-card__title align-start">
                                    <div
                                        class="overflow-hidden mt-n9 transition-swing v-card--material__sheet v-sheet theme--light elevation-6 rounded"
                                        style="max-width: 100%; background-color: rgb(253, 154, 19); border-color: rgb(253, 154, 19);"
                                    >
                                        <div class="pa-8">
                                            <i
                                                aria-hidden="true"
                                                class="v-icon notranslate mdi mdi-sofa-single theme--dark"
                                                style="font-size: 36px;"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="text-h4 v-card--material__title pl-3"
                                    >
                                        <!-- {{ $t("dashboard.borrowing") }} -->
                                       
                                        <div class="text-subtitle-1 mb-n4">
                                            <div
                                                class="text-right text-h3 v-card__subtitle--material-stats"
                                            >
                                                <!-- {{
                                                    dashboard.number_of_borrowing
                                                }} -->
                                                 Borrowing
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <hr
                                    role="separator"
                                    aria-orientation="horizontal"
                                    class="mt-2 mx-4 v-divider theme--light"
                                />
                                <div
                                    class="v-card__actions px-4 text-caption grey--text"
                                >
                                    <i
                                        aria-hidden="true"
                                        class="v-icon notranslate mr-2 mdi mdi-alert theme--light"
                                        style="font-size: 16px;"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-12">
                            <div
                                class="v-card--material mt-4 v-card--material-stats v-card v-sheet theme--light"
                                color="#FD9A13"
                                icon="mdi-sofa-single"
                                title="Bookings"
                            >
                                <div class="v-card__title align-start">
                                    <div
                                        class="overflow-hidden mt-n9 transition-swing v-card--material__sheet v-sheet theme--light elevation-6 rounded"
                                        style="max-width: 100%; background-color: rgb(253, 154, 19); border-color: rgb(253, 154, 19);"
                                    >
                                        <div class="pa-8">
                                            <i
                                                aria-hidden="true"
                                                class="v-icon notranslate mdi mdi-sofa-single theme--dark"
                                                style="font-size: 36px;"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="text-h4 v-card--material__title pl-3"
                                    >
                                        <!-- {{ $t("dashboard.Return") }} -->
                                        
                                        <div class="text-subtitle-1 mb-n4">
                                            <div
                                                class="text-right text-h3 v-card__subtitle--material-stats"
                                            >
                                                <!-- {{ dashboard.number_of_return }} -->
                                                Return
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <hr
                                    role="separator"
                                    aria-orientation="horizontal"
                                    class="mt-2 mx-4 v-divider theme--light"
                                />
                                <div
                                    class="v-card__actions px-4 text-caption grey--text"
                                >
                                    <i
                                        aria-hidden="true"
                                        class="v-icon notranslate mr-2 mdi mdi-alert theme--light"
                                        style="font-size: 16px;"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </TemplateA>
    </div>
</template>
<script>
export default {
    mounted() {
        // this.init();
        this.getDashBoardData();
    },
    data() {
        return {
            dashboard: {}
        };
    },
    methods: {
        getDashBoardData() {
            this.$chttp.get("dashboard-data", this.filters).then(res => {
                // console.log(res.data);
                this.dashboard = res.data;
                // console.log(res);
            });
        }

        // init() {
        //     var ctx = document.getElementById('myChart').getContext('2d');
        //         var myChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //             datasets: [{
        //                 label: '# of Votes',
        //                 data: [12, 19, 3, 5, 2, 3],
        //                 backgroundColor: [
        //                     'rgba(255, 99, 132, 0.2)',
        //                     'rgba(54, 162, 235, 0.2)',
        //                     'rgba(255, 206, 86, 0.2)',
        //                     'rgba(75, 192, 192, 0.2)',
        //                     'rgba(153, 102, 255, 0.2)',
        //                     'rgba(255, 159, 64, 0.2)'
        //                 ],
        //                 borderColor: [
        //                     'rgba(255, 99, 132, 1)',
        //                     'rgba(54, 162, 235, 1)',
        //                     'rgba(255, 206, 86, 1)',
        //                     'rgba(75, 192, 192, 1)',
        //                     'rgba(153, 102, 255, 1)',
        //                     'rgba(255, 159, 64, 1)'
        //                 ],
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        // }
    }
};
</script>
