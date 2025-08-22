<form action="process_form.php" method="POST" class="p-6 pos-bg rounded-b-lg">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mb-4 items-end">
        <div class="col-span-1">
            <label for="rno" class="block text-xs font-medium text-gray-700">RNO</label>
            <input type="text" id="rno" name="rno" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <div class="col-span-1">
            <label for="type" class="block text-xs font-medium text-gray-700">TYPE</label>
            <select id="type" name="type" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option>Cash Sale</option>
                <option>Credit Sale</option>
            </select>
        </div>
        <div class="col-span-1">
            <label for="date" class="block text-xs font-medium text-gray-700">DATE</label>
            <input type="date" id="date" name="date" value="2025-08-20" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <div class="col-span-1">
            <label for="store" class="block text-xs font-medium text-gray-700">STORE</label>
            <select id="store" name="store" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option>BABULSAALAAM</option>
            </select>
        </div>
        <div class="col-span-1">
            <label for="customer" class="block text-xs font-medium text-gray-700">CUSTOMER</label>
            <select id="customer" name="customer" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option>CASH</option>
            </select>
        </div>
        <div class="col-span-1">
            <label for="ac_no" class="block text-xs font-medium text-gray-700">AC NO</label>
            <input type="text" id="ac_no" name="ac_no" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <div class="col-span-1 flex items-center">
            <input type="checkbox" id="collectDriver" name="collectDriver" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-offset-0 focus:ring-blue-200 focus:ring-opacity-50">
            <label for="collectDriver" class="ml-2 text-xs text-gray-700">Set Collect Driver</label>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 mb-4 items-end">
        <div class="col-span-1">
            <label for="lpo_ref_no" class="block text-xs font-medium text-gray-700">LPO / REF NO</label>
            <input type="text" id="lpo_ref_no" name="lpo_ref_no" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <div class="col-span-1">
            <label for="sales_person" class="block text-xs font-medium text-gray-700">Sales Person</label>
            <input type="text" id="sales_person" name="sales_person" value="MR HARUN BASHIR" readonly disabled class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-gray-200">
        </div>
        <div class="col-span-1">
            <label for="payment_terms" class="block text-xs font-medium text-gray-700">Payment Terms</label>
            <select id="payment_terms" name="payment_terms" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option>Cash on Delivery</option>
            </select>
        </div>
        <div class="col-span-1">
            <label for="due_date" class="block text-xs font-medium text-gray-700">Due Date</label>
            <input type="date" id="due_date" name="due_date" value="2025-08-20" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <div class="col-span-1 flex items-center">
            <input type="checkbox" id="unavailable_items" name="unavailable_items" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-offset-0 focus:ring-blue-200 focus:ring-opacity-50">
            <label for="unavailable_items" class="ml-2 text-xs text-gray-700">Include Unavailable Items</label>
        </div>
    </div>

    <div class="flex items-center gap-2 mb-4">
        <label for="filter" class="block text-xs font-medium text-gray-700 whitespace-nowrap">Filter:</label>
        <input type="text" id="filter" name="filter" class="p-1 w-full rounded-md border border-gray-400 text-xs focus:ring-blue-500 focus:border-blue-500 bg-white">
        <button type="button" class="pos-button px-4 py-1 text-xs rounded-md h-full">Filter</button>
    </div>

    <div class="pos-grid-bg rounded-md shadow-inner p-2 border border-gray-400 overflow-y-auto" style="max-height: 250px;">
        <div class="pos-grid-header grid grid-cols-9 text-xs font-bold text-gray-800 p-2 rounded-t-md border-b border-gray-300">
            <div class="col-span-2">Item Description</div>
            <div>Packing</div>
            <div>Units</div>
            <div>Quantity</div>
            <div>Unit Price</div>
            <div>Disc %</div>
            <div>Discount</div>
            <div>Total Amt</div>
        </div>
        <div class="space-y-1 mt-1 text-xs">
            <div class="grid grid-cols-9 p-2 hover:bg-gray-100 rounded-sm">
                <div class="col-span-2">Test Item 1</div>
                <div>PACK</div>
                <div>CTN</div>
                <input type="number" value="1.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="100.00" class="w-16 border border-gray-300 rounded-sm text-center">
                <input type="number" value="0.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="0.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="100.00" class="w-16 border-none bg-transparent font-semibold">
            </div>
            <div class="grid grid-cols-9 p-2 hover:bg-gray-100 rounded-sm">
                <div class="col-span-2">Test Item 2</div>
                <div>PACK</div>
                <div>CTN</div>
                <input type="number" value="7.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="100.00" class="w-16 border border-gray-300 rounded-sm text-center">
                <input type="number" value="0.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="0.00" class="w-12 border border-gray-300 rounded-sm text-center">
                <input type="number" value="700.00" class="w-16 border-none bg-transparent font-semibold">
            </div>
        </div>
    </div>

    <div class="mt-4 flex flex-col md:flex-row justify-between items-start md:items-end">
        <div class="grid grid-cols-2 gap-3 mb-4 md:mb-0">
            <div>
                <label for="bill" class="block text-xs font-medium text-gray-700">Bill</label>
                <input type="text" id="bill" name="bill" value="200.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
            <div>
                <label for="paid" class="block text-xs font-medium text-gray-700">Paid</label>
                <input type="text" id="paid" name="paid" value="0.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
            <div>
                <label for="vat" class="block text-xs font-medium text-gray-700">VAT</label>
                <input type="text" id="vat" name="vat" value="0.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
            <div>
                <label for="prepaid" class="block text-xs font-medium text-gray-700">Prepaid</label>
                <input type="text" id="prepaid" name="prepaid" value="0.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
            <div>
                <label for="transport" class="block text-xs font-medium text-gray-700">Transport</label>
                <input type="text" id="transport" name="transport" value="0.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
            <div>
                <label for="discount" class="block text-xs font-medium text-gray-700">Discount</label>
                <input type="text" id="discount" name="discount" value="0.00" class="mt-1 p-1 w-full rounded-md border border-gray-400 text-xs bg-white">
            </div>
        </div>

        <div class="flex flex-wrap gap-2 justify-end">
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Complete</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Print</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">New</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Modify</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Void</button>
            <button type="submit" class="pos-button pos-button-save px-3 py-1 text-xs rounded-md">Save</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md" onclick="document.getElementById('pos-popup').remove();">Cancel</button>
            <button type="button" class="pos-button px-3 py-1 text-xs rounded-md">Copy</button>
        </div>
    </div>
    <script>
        function togglePopup() {
            const popup = document.getElementById('pos-popup');
            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden');
            } else {
                popup.classList.add('hidden');
            }
        }
    </script>
</form>
  