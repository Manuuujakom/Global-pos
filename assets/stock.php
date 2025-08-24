
    <!-- Use Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Use Inter font from Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom styles for the modal */
        .modal {
            transition: all 0.3s ease-in-out;
        }
        .modal-content {
            animation: slide-down 0.3s ease-in-out;
        }
        @keyframes slide-down {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>

<body class="bg-gray-100 p-4 min-h-screen">

    <!-- Main Application Form Container -->
    <form id="purchase-form" class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg p-6 space-y-6">

        <!-- Form Header -->
        <header class="border-b-2 border-gray-200 pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Direct Purchases / Stocking</h1>
            
            <!-- First Line of Header -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-6 gap-4 mt-4">
                <div class="flex flex-col">
                    <label for="folio-no" class="text-sm font-medium text-gray-600">Folio No.</label>
                    <input type="text" id="folio-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="date" class="text-sm font-medium text-gray-600">Date</label>
                    <input type="date" id="date" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="store" class="text-sm font-medium text-gray-600">Store</label>
                    <input type="text" id="store" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="show-sale-price" class="form-checkbox h-4 w-4 text-blue-600 rounded-md">
                    <label for="show-sale-price" class="text-sm font-medium text-gray-700">Show Sale Price</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="weight" class="form-checkbox h-4 w-4 text-blue-600 rounded-md">
                    <label for="weight" class="text-sm font-medium text-gray-700">Weight</label>
                </div>
            </div>

            <!-- Second Line of Header -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="flex flex-col">
                    <label for="supplier" class="text-sm font-medium text-gray-600">Supplier</label>
                    <input type="text" id="supplier" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="ref-no" class="text-sm font-medium text-gray-600">Ref No.</label>
                    <input type="text" id="ref-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="sup-date" class="text-sm font-medium text-gray-600">Date</label>
                    <input type="date" id="sup-date" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="pin" class="text-sm font-medium text-gray-600">PIN</label>
                    <input type="text" id="pin" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Third Line of Header -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="flex flex-col">
                    <label for="v-reg-no" class="text-sm font-medium text-gray-600">V.Reg No.</label>
                    <input type="text" id="v-reg-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="id-pp" class="text-sm font-medium text-gray-600">ID/PP</label>
                    <input type="text" id="id-pp" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="tel-no" class="text-sm font-medium text-gray-600">Telephone Number</label>
                    <input type="tel" id="tel-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="cu-no" class="text-sm font-medium text-gray-600">Cu No.</label>
                    <input type="text" id="cu-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Quick Add Button -->
            <div class="flex justify-start mt-4">
                <button type="button" id="quick-add-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-colors">Quick Add</button>
            </div>
        </header>

        <!-- Main Display Space -->
        <main class="space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <a href="https://www.kra.go.ke/" target="_blank" class="text-blue-600 hover:underline">KRA Link</a>
                <button type="button" id="filter-btn" class="mt-2 sm:mt-0 px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">Filter</button>
            </div>

            <!-- Primary Display Table -->
            <div class="overflow-x-auto rounded-lg shadow-sm">
                <table class="min-w-full bg-white text-sm">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                            <th class="py-3 px-6 text-left">Item Number</th>
                            <th class="py-3 px-6 text-left">Item Description</th>
                            <th class="py-3 px-6 text-left">Packing Units</th>
                            <th class="py-3 px-6 text-left">Quantity</th>
                            <th class="py-3 px-6 text-left">VAT Ddon</th>
                            <th class="py-3 px-6 text-left">Unit Cost</th>
                            <th class="py-3 px-6 text-left sale-price">Sale Price Out</th>
                            <th class="py-3 px-6 text-left sale-price">Inner Parts</th>
                            <th class="py-3 px-6 text-left sale-price">Sale Price In</th>
                            <th class="py-3 px-6 text-left sale-price">Retail Parts</th>
                            <th class="py-3 px-6 text-left sale-price">Retail Price</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <!-- Example row, can be dynamically added -->
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">001</td>
                            <td class="py-3 px-6 text-left">Example Item</td>
                            <td class="py-3 px-6 text-left">Box</td>
                            <td class="py-3 px-6 text-left">10</td>
                            <td class="py-3 px-6 text-left">16%</td>
                            <td class="py-3 px-6 text-left">$5.00</td>
                            <td class="py-3 px-6 text-left sale-price">$8.00</td>
                            <td class="py-3 px-6 text-left sale-price">5</td>
                            <td class="py-3 px-6 text-left sale-price">$1.60</td>
                            <td class="py-3 px-6 text-left sale-price">2</td>
                            <td class="py-3 px-6 text-left sale-price">$0.80</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Second Table (Filtered View) - Hidden by default -->
            <div id="filtered-table-container" class="overflow-x-auto rounded-lg shadow-sm hidden">
                <table class="min-w-full bg-white text-sm">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                            <th class="py-3 px-6 text-left">Category</th>
                            <th class="py-3 px-6 text-left">Item No.</th>
                            <th class="py-3 px-6 text-left">Item Description</th>
                            <th class="py-3 px-6 text-left">Cost Price</th>
                            <th class="py-3 px-6 text-left">Unit of Measure</th>
                            <th class="py-3 px-6 text-left">Units Available</th>
                            <th class="py-3 px-6 text-left">Tax Code</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <!-- Example row for filtered table -->
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">Electronics</td>
                            <td class="py-3 px-6 text-left">ELEC-001</td>
                            <td class="py-3 px-6 text-left">Keyboard</td>
                            <td class="py-3 px-6 text-left">$25.00</td>
                            <td class="py-3 px-6 text-left">pcs</td>
                            <td class="py-3 px-6 text-left">50</td>
                            <td class="py-3 px-6 text-left">VAT</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Footer / Bill Summary -->
        <footer class="border-t-2 border-gray-200 pt-4 mt-6">
            <h2 class="text-xl font-bold text-gray-800">Bill Summary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                <div class="flex flex-col">
                    <label for="bill-amount" class="text-sm font-medium text-gray-600">Bill Amount</label>
                    <input type="text" id="bill-amount" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
                <div class="flex flex-col">
                    <label for="weight-amount" class="text-sm font-medium text-gray-600">Weight Amount</label>
                    <input type="text" id="weight-amount" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
                <div class="flex flex-col">
                    <label for="vat-amount" class="text-sm font-medium text-gray-600">VAT Amount</label>
                    <input type="text" id="vat-amount" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
                <div class="flex flex-col">
                    <label for="paid-amount" class="text-sm font-medium text-gray-600">Paid Amount</label>
                    <input type="text" id="paid-amount" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="total-change" class="text-sm font-medium text-gray-600">Total Change</label>
                    <input type="text" id="total-change" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
                <div class="flex flex-col">
                    <label for="prepaid-amount" class="text-sm font-medium text-gray-600">Prepaid Amount</label>
                    <input type="text" id="prepaid-amount" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
                <div class="flex flex-col">
                    <label for="balance-due" class="text-sm font-medium text-gray-600">Balance Due</label>
                    <input type="text" id="balance-due" value="0.00" disabled class="mt-1 p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex flex-wrap justify-end gap-2 mt-6">
                <button type="button" onclick="handleAction('Print')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors">Print</button>
                <button type="button" onclick="handleAction('New')" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">New</button>
                <button type="button" onclick="handleAction('Modify')" class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">Modify</button>
                <button type="button" onclick="handleAction('Save')" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Save</button>
                <button type="button" onclick="handleAction('Void')" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Void</button>
                <button type="button" onclick="handleAction('Cancel')" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                <button type="button" onclick="handleAction('Close')" class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors">Close</button>
            </div>
        </footer>

    </form>

    <!-- Quick Add Creditor Account Modal -->
    <div id="quick-add-modal" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <form class="modal-content bg-white p-6 rounded-xl shadow-2xl max-w-2xl w-full mx-4">
            <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">Quick Add Creditor Account</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label for="acc-no" class="text-sm font-medium text-gray-600">Account No.</label>
                    <input type="text" id="acc-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="company-name" class="text-sm font-medium text-gray-600">Company Name</label>
                    <input type="text" id="company-name" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="contact-person" class="text-sm font-medium text-gray-600">Contact Person</label>
                    <input type="text" id="contact-person" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="contact-title" class="text-sm font-medium text-gray-600">Contact Title</label>
                    <input type="text" id="contact-title" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col sm:col-span-2">
                    <label for="address" class="text-sm font-medium text-gray-600">Address</label>
                    <input type="text" id="address" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="town-city" class="text-sm font-medium text-gray-600">Town/City</label>
                    <input type="text" id="town-city" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="region" class="text-sm font-medium text-gray-600">Region</label>
                    <input type="text" id="region" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="postal-code" class="text-sm font-medium text-gray-600">Postal Code</label>
                    <input type="text" id="postal-code" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="country" class="text-sm font-medium text-gray-600">Country</label>
                    <input type="text" id="country" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="phone-no" class="text-sm font-medium text-gray-600">Phone No.</label>
                    <input type="tel" id="phone-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="fax-no" class="text-sm font-medium text-gray-600">Fax No.</label>
                    <input type="text" id="fax-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="pin-no" class="text-sm font-medium text-gray-600">PIN No.</label>
                    <input type="text" id="pin-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="vat-no" class="text-sm font-medium text-gray-600">VAT No.</label>
                    <input type="text" id="vat-no" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="home-page" class="text-sm font-medium text-gray-600">Home Page</label>
                    <input type="text" id="home-page" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col">
                    <label for="payment-terms" class="text-sm font-medium text-gray-600">Payment Terms</label>
                    <input type="text" id="payment-terms" class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" id="add-creditor-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Add</button>
                <button type="button" id="cancel-creditor-btn" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // Get references to DOM elements
        const quickAddBtn = document.getElementById('quick-add-btn');
        const quickAddModal = document.getElementById('quick-add-modal');
        const addCreditorBtn = document.getElementById('add-creditor-btn');
        const cancelCreditorBtn = document.getElementById('cancel-creditor-btn');
        const filterBtn = document.getElementById('filter-btn');
        const filteredTableContainer = document.getElementById('filtered-table-container');
        const showSalePriceCheckbox = document.getElementById('show-sale-price');
        const salePriceFields = document.querySelectorAll('.sale-price');

        // Function to toggle the quick add modal visibility
        function toggleQuickAddModal() {
            quickAddModal.classList.toggle('hidden');
        }

        // Function to toggle the filtered table visibility
        function toggleFilteredTable() {
            filteredTableContainer.classList.toggle('hidden');
        }

        // Function to toggle visibility/disability of sale price fields
        function toggleSalePriceFields() {
            salePriceFields.forEach(field => {
                if (showSalePriceCheckbox.checked) {
                    field.classList.remove('hidden');
                } else {
                    field.classList.add('hidden');
                }
            });
        }

        // Placeholder function for footer buttons
        function handleAction(event, action) {
            // Prevent the default form submission action
            event.preventDefault();
            console.log(`User clicked the "${action}" button.`);
        }

        // Event listeners for button clicks
        quickAddBtn.addEventListener('click', toggleQuickAddModal);
        cancelCreditorBtn.addEventListener('click', toggleQuickAddModal);
        addCreditorBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent modal form submission
            console.log('Creditor account added!');
            toggleQuickAddModal();
        });

        filterBtn.addEventListener('click', toggleFilteredTable);
        
        // Event listener for the show sale price checkbox
        showSalePriceCheckbox.addEventListener('change', toggleSalePriceFields);

        // Initial state of sale price fields based on checkbox
        toggleSalePriceFields();
    </script>

</body>

