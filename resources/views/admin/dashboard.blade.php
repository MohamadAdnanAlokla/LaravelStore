@include('admin.navigation')


    <div class="container mx-auto mt-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Total Registered Users -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-users text-blue-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Registered Users</h2>
                </div>
                <p class="text-2xl font-bold">{{ $usersCount }}</p>
            </div>

            <!-- Total Carts Created -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-shopping-cart text-green-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Carts Created</h2>
                </div>
                <p class="text-2xl font-bold">{{ $cartsCount }}</p>
            </div>

            <!-- Total Products Available for Sale -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-box-open text-yellow-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Products Available for Sale</h2>
                </div>
                <p class="text-2xl font-bold">{{ $productsCount }}</p>
            </div>

            <!-- Total Completed Orders -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-check-circle text-purple-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Completed Orders</h2>
                </div>
                <p class="text-2xl font-bold">{{ $completedOrdersCount }}</p>
            </div>

            <!-- Total Reviews Received -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-star text-yellow-400 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Reviews Received</h2>
                </div>
                <p class="text-2xl font-bold">{{ $reviewsCount }}</p>
            </div>

            <!-- Best Selling Product -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-trophy text-red-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Best Selling Product</h2>
                </div>
                <p class="text-lg font-bold">{{ $bestSellingProduct->name }}</p>
                <p class="text-sm">Quantity: {{ $bestSellingProduct->total_quantity }}</p>
            </div>

            <!-- Lowest Selling Product -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-arrow-down text-blue-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Lowest Selling Product</h2>
                </div>
                <p class="text-lg font-bold">{{ $lowestSellingProduct->name }}</p>
                <p class="text-sm">Quantity: {{ $lowestSellingProduct->total_quantity }}</p>
            </div>

            <!-- Highest Revenue Product -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-dollar-sign text-green-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Highest Revenue Product</h2>
                </div>
                <p class="text-lg font-bold">{{ $highestRevenueProduct->name }}</p>
                <p class="text-sm">Revenue: ${{ $highestRevenueProduct->total_revenue }}</p>
            </div>

            <!-- Total Sales for the Current Month -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-line text-purple-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Sales for the Current Month</h2>
                </div>
                <p class="text-lg font-bold">${{ $currentMonthSales }}</p>
            </div>

            <!-- Total Sales for the Current Year -->
            <div class="bg-white p-4 shadow-md">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-bar text-yellow-500 text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold">Total Sales for the Current Year</h2>
                </div>
                <p class="text-lg font-bold">${{ $currentYearSales }}</p>
            </div>
        </div>
    </div>

    <br><br><br><br>

    


    <div style="max-width: 800px; margin: 0 auto;">
        <canvas id="salesBarChart"></canvas>
    </div>

    <script>
        // Extracted data from the controller
        const labels = {!! json_encode($labels) !!};
        const salesAmounts = {!! json_encode($salesAmounts) !!};

        // Chart.js initialization for the bar chart
        const salesBarChart = new Chart(document.getElementById("salesBarChart"), {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Monthly Sales",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                    data: salesAmounts,
                }]
            },
            options: {
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: "Month",
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: "Sales",
                        },
                    },
                },
            },
        });
    </script>



<br><br><br><br><br><br>
@include('admin.down')

<!-- Script to initialize the profit chart -->

