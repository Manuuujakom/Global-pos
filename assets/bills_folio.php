<?php
/**
 * bills-folio-register.php
 *
 * This form displays the Bills Folio Register. It provides filtering
 * and search options, a detailed table of bills, and a footer with
 * total amounts and action buttons.
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
// $bills = fetchBillsFromDatabase($_GET['startDate'], $_GET['endDate'], $_GET['currency'], $_GET['supplier']);
// $totalBillAmount = calculateTotalBillAmount($bills);
// $totalTaxAmount = calculateTotalTaxAmount($bills);
// $totalNetAmount = calculateTotalNetAmount($bills);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills Folio Register</title>
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
</head>
<body class="bg-gray-100 font-sans">
    <form action="#" method="POST" class="p-6 pos-bg rounded-b-lg">
        
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <button type="button" class="pos-button px-4 py-2 text-xs rounded-md">Filter By</button>
            
            <div class="flex-1 min-w-[120px]">
                <label for="startDate" class="block text-xs font-medium text-gray-700">Start Date</label>
                <input type="date" id="startDate" name="startDate" value="" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
            </div>
            
            <div class="flex-1 min-w-[120px]">
                <label for="endDate" class="block text-xs font-medium text-gray-700">End Date</label>
                <input type="date" id="endDate" name="endDate" value="" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
            </div>
            
            <div class="flex-1 min-w-[120px]">
                <label for="currency" class="block text-xs font-medium text-gray-700">Currency</label>
                <select id="currency" name="currency" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">Select Currency</option>
                    <?php 
                        // Example: 
                        // foreach ($currencies as $currency) {
                        //     echo "<option value='{$currency['id']}'>{$currency['name']}</option>";
                        // }
                    ?>
                </select>
            </div>
            
            <div class="flex-1 min-w-[120px]">
                <label for="supplier" class="block text-xs font-medium text-gray-700">Supplier</label>
                <select id="supplier" name="supplier" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">Select Supplier</option>
                    <?php 
                        // Example:
                        // foreach ($suppliers as $supplier) {
                        //     echo "<option value='{$supplier['id']}'>{$supplier['name']}</option>";
                        // }
                    ?>
                </select>
            </div>
            
            <button type="button" class="pos-button px-4 py-2 text-xs rounded-md">Search</button>
        </div>

        <div class="flex justify-end items-center gap-4 mb-4">
            <div class="flex items-center">
                <input type="checkbox" id="includePaidBills" name="includePaidBills" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                <label for="includePaidBills" class="ml-2 text-xs text-gray-700 whitespace-nowrap">Include Paid Bills</label>
            </div>
            
            <button type="button" class="pos-button px-4 py-2 text-xs rounded-md">Records Info</button>
        </div>

        <div class="pos-grid-bg rounded-md shadow-inner p-2 border border-gray-400 overflow-x-auto" style="max-height: 400px;">
            <div class="pos-grid-header grid grid-cols-[repeat(11,minmax(0,1fr))] gap-2 text-xs font-bold text-gray-800 p-2 rounded-t-md border-b border-gray-300">
                <div class="col-span-1">Folio No.</div>
                <div class="col-span-1">Folio Date</div>
                <div class="col-span-2">Supplier's Name</div>
                <div class="col-span-1">Bill No.</div>
                <div class="col-span-1">Bill Type</div>
                <div class="col-span-1">Currency</div>
                <div class="col-span-1">Total Amount</div>
                <div class="col-span-1">Tax Amount</div>
                <div class="col-span-1">Weight Amount</div>
                <div class="col-span-1">Balance Amount</div>
                <div class="col-span-1">Due Date</div>
            </div>
            
            <div class="space-y-1 mt-1 text-xs">
                <?php 
                    // Example:
                    // if (!empty($bills)) {
                    //     foreach ($bills as $bill) {
                    //         echo "<div class='grid grid-cols-[repeat(11,minmax(0,1fr))] gap-2 p-2 hover:bg-gray-100 rounded-sm'>";
                    //         echo "<div>{$bill['folio_no']}</div>";
                    //         echo "<div>{$bill['folio_date']}</div>";
                    //         echo "<div class='col-span-2'>{$bill['supplier_name']}</div>";
                    //         echo "<div>{$bill['bill_no']}</div>";
                    //         echo "<div>{$bill['bill_type']}</div>";
                    //         echo "<div>{$bill['currency']}</div>";
                    //         echo "<div>{$bill['total_amount']}</div>";
                    //         echo "<div>{$bill['tax_amount']}</div>";
                    //         echo "<div>{$bill['weight_amount']}</div>";
                    //         echo "<div>{$bill['balance_amount']}</div>";
                    //         echo "<div>{$bill['due_date']}</div>";
                    //         echo "</div>";
                    //     }
                    // } else {
                    //     echo "<div class='p-4 text-center text-gray-500'>No bills found.</div>";
                    // }
                ?>
            </div>
        </div>
        
        <div class="mt-4 flex flex-col md:flex-row justify-between items-start md:items-end">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4 md:mb-0">
                <div>
                    <label for="billAmountTotal" class="block text-xs font-medium text-gray-700">Total Bill Amount</label>
                    <input type="text" id="billAmountTotal" name="billAmountTotal" value="<?php /* echo $totalBillAmount; */ ?>" readonly class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200 font-bold">
                </div>
                <div>
                    <label for="taxAmountTotal" class="block text-xs font-medium text-gray-700">Total Tax Amount</label>
                    <input type="text" id="taxAmountTotal" name="taxAmountTotal" value="<?php /* echo $totalTaxAmount; */ ?>" readonly class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200 font-bold">
                </div>
                <div>
                    <label for="netAmountTotal" class="block text-xs font-medium text-gray-700">Total Net Amount</label>
                    <input type="text" id="netAmountTotal" name="netAmountTotal" value="<?php /* echo $totalNetAmount; */ ?>" readonly class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200 font-bold">
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Print or Preview</button>
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Add Bill</button>
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Apply Changes</button>
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md bg-red-500 hover:bg-red-600">Delete Marked</button>
                <button type="button" class="pos-button px-3 py-1 text-xs rounded-md" onclick="closePosForm()">Close</button>
            </div>
        </div>
    </form>
</body>
</html>