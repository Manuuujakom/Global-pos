<?php
/**
 * sales-order-management.php
 *
 * This form displays the Sales Order Management dashboard. It provides
 * filtering and search options, a detailed table of sales orders, and
 * a footer with total amounts and action buttons.
 *
 * This file is intended to be loaded dynamically into the main dashboard
 * but is a standalone HTML file for demonstration purposes.
 *
 * Note: All hardcoded values have been removed. The placeholders (e.g.,
 * <?php echo $variable; ?>) are where you would fetch and display
 * dynamic data from a database.
 */

// Placeholder for database connection and data fetching logic
// Example:
// require_once 'database_connection.php';
// $salesOrders = fetchSalesOrdersFromDatabase($_GET['orderDate'], $_GET['createdBy'], $_GET['driver']);
// $totalAmount = calculateTotalAmount($salesOrders);
// $totalWeight = calculateTotalWeight($salesOrders);

?>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Define custom colors and styles to match the DuroPOS theme */
        .pos-bg {
            background-color: #f7f7f7;
            /* Light gray background for the form area */
        }

        .pos-grid-bg {
            background-color: #e9e9e9;
            /* Slightly darker gray for the grid container */
        }

        .pos-grid-header {
            background-color: #d1d5db;
            /* Header background for the grid */
        }

        .pos-button {
            background-color: #3b82f6;
            /* bg-blue-500 */
            color: white;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .pos-button:hover {
            background-color: #2563eb;
            /* bg-blue-600 */
            transform: scale(1.05);
        }
        
        /* Styles for the button-like info boxes */
        .info-box-button {
            @apply flex flex-col items-start p-2 rounded-md bg-gray-200 border border-gray-300 shadow-sm transition-transform duration-200 ease-in-out hover:bg-gray-300 hover:scale-105 cursor-pointer;
        }
        .info-box-button .label {
            @apply block text-xs font-medium text-gray-700 mb-1;
        }
        .info-box-button .value {
            @apply text-sm font-semibold text-gray-900;
        }
    </style>

<body class="bg-gray-100 font-sans">
    <form action="#" method="POST" class="p-6 pos-bg rounded-b-lg">
        
        <!-- --- Header Section - First Row (Order Details) --- -->
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <!-- Order Date Input -->
            <div class="flex-1 min-w-[120px]">
                <label for="orderDate" class="block text-xs font-medium text-gray-700">Order Date</label>
                <input type="date" id="orderDate" name="orderDate" value="" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
            </div>
            
            <!-- Created By Dropdown -->
            <div class="flex-1 min-w-[120px]">
                <label for="createdBy" class="block text-xs font-medium text-gray-700">Created By</label>
                <select id="createdBy" name="createdBy" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <!-- Options to be populated by PHP from database -->
                    <option value="">Select Creator</option>
                    <?php 
                        // Example:
                        // foreach ($creators as $creator) {
                        //     echo "<option value='{$creator['id']}'>{$creator['name']}</option>";
                        // }
                    ?>
                </select>
            </div>
            
            <!-- Driver Dropdown -->
            <div class="flex-1 min-w-[120px]">
                <label for="driver" class="block text-xs font-medium text-gray-700">Driver</label>
                <select id="driver" name="driver" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <!-- Options to be populated by PHP from database -->
                    <option value="">Select Driver</option>
                    <?php 
                        // Example:
                        // foreach ($drivers as $driver) {
                        //     echo "<option value='{$driver['id']}'>{$driver['name']}</option>";
                        // }
                    ?>
                </select>
            </div>
            
            <!-- Entries Input -->
            <div class="flex-1 min-w-[120px]">
                <label for="entries" class="block text-xs font-medium text-gray-700">Entries</label>
                <input type="number" id="entries" name="entries" value="" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
            </div>
        </div>

        <!-- --- Header Section - Second Row (Checkboxes) --- -->
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <!-- Pending Orders Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="pendingOrders" name="pendingOrders" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="pendingOrders" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Pending Orders</label>
            </div>
            
            <!-- Show Breakdown Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="showBreakdown" name="showBreakdown" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="showBreakdown" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Show Breakdown</label>
            </div>
            
            <!-- Invoice List Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="invoiceList" name="invoiceList" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="invoiceList" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Invoice List</label>
            </div>
            
            <!-- Processed Sales Orders Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="processedSalesOrders" name="processedSalesOrders" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="processedSalesOrders" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Processed Sales Orders</label>
            </div>

            <!-- Combined Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="combined" name="combined" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="combined" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Combined</label>
            </div>
        </div>

        <!-- --- Displayed Information - Table/Grid --- -->
        <div class="pos-grid-bg rounded-md shadow-inner p-2 border border-gray-400 overflow-x-auto" style="max-height: 400px;">
            <div class="pos-grid-header grid grid-cols-[repeat(8,minmax(0,1fr))] gap-2 text-xs font-bold text-gray-800 p-2 rounded-t-md border-b border-gray-300">
                <div class="col-span-1">Date</div>
                <div class="col-span-1">Customer's Name</div>
                <div class="col-span-1">Driver</div>
                <div class="col-span-1">Sales RP</div>
                <div class="col-span-1">Invoice</div>
                <div class="col-span-1">CC</div>
                <div class="col-span-1">Total Amount</div>
                <div class="col-span-1">Gross Net</div>
            </div>
            
            <!-- Data Rows to be populated by PHP from database -->
            <div class="space-y-1 mt-1 text-xs">
                <?php 
                    // Example:
                    // if (!empty($salesOrders)) {
                    //     foreach ($salesOrders as $order) {
                    //         echo "<div class='grid grid-cols-[repeat(8,minmax(0,1fr))] gap-2 p-2 hover:bg-gray-100 rounded-sm'>";
                    //         echo "<div>{$order['date']}</div>";
                    //         echo "<div>{$order['customer_name']}</div>";
                    //         echo "<div>{$order['driver']}</div>";
                    //         echo "<div>{$order['sales_rp']}</div>";
                    //         echo "<div>{$order['invoice']}</div>";
                    //         echo "<div>{$order['cc']}</div>";
                    //         echo "<div>{$order['total_amount']}</div>";
                    //         echo "<div>{$order['gross_net']}</div>";
                    //         echo "</div>";
                    //     }
                    // } else {
                    //     echo "<div class='p-4 text-center text-gray-500'>No sales orders found.</div>";
                    // }
                ?>
            </div>
        </div>
        
        <!-- --- Footer Section - Totals & Action Buttons --- -->
        <div class="mt-4 flex flex-col md:flex-row justify-between items-start md:items-end">
            <!-- First line of footer buttons/info -->
            <div class="flex flex-wrap items-center gap-2 mb-4 md:mb-0">
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Select All</button>
                <div class="flex-1 min-w-[120px]">
                    <label for="totalAmount" class="block text-xs font-medium text-gray-700">Total Amount</label>
                    <input type="text" id="totalAmount" name="totalAmount" value="<?php /* echo $totalAmount; */ ?>" readonly class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200 font-bold">
                </div>
                <div class="flex-1 min-w-[120px]">
                    <label for="totalWeight" class="block text-xs font-medium text-gray-700">Total Weight</label>
                    <input type="text" id="totalWeight" name="totalWeight" value="<?php /* echo $totalWeight; */ ?>" readonly class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200 font-bold">
                </div>
            </div>

            <!-- Second line of footer buttons -->
            <div class="flex flex-wrap justify-between w-full md:w-auto gap-2">
                <!-- Left-aligned buttons -->
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Add</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md bg-red-500 hover:bg-red-600">Delete</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Refresh</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Process Invoice</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Process Orders</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Shortage Check</button>
                </div>
                <!-- Right-aligned buttons -->
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Print</button>
                    <button type="button" class="pos-button px-3 py-1 text-xs rounded-md" onclick="closePosForm()">Close</button>
                </div>
            </div>
        </div>
    </form>
</body>

