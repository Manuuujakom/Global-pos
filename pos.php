<?php
/**
 * welcome.php
 *
 * This is the main dashboard page for the DuroPOS system.
 * It contains the main navigation headers and a placeholder for content.
 *
 * It checks for an active session to ensure the user is logged in.
 * If no session is found, the user is redirected to the login page.
 */

// Start a new session or resume the existing one.
session_start();

// Check if the user is logged in.
// If not, redirect them to the login page.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Get the username and department from the session to display on the page.
$username = $_SESSION['username'] ?? 'User';
$department = $_SESSION['department'] ?? 'Department';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuroPOS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the nav items */
        .nav-link {
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .nav-link:hover {
            color: #ffffff;
            background-color: #3b82f6; /* bg-blue-500 */
        }
        
        /* Underline effect on hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #ffffff;
            transition: width 0.4s ease;
            -webkit-transition: width 0.4s ease;
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
            background: #ffffff;
        }

        /* The key change: fix the header and add padding to the body */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50; /* Ensure it's above other content but below popups */
        }
        
        /* The header now uses a flexible layout to handle three distinct rows. */
        .header-content {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* * FIX: Adjust body padding to dynamically accommodate the header on different screen sizes. 
         * This prevents the header from taking up too much space on small devices.
         */
        body {
            /* Base padding for larger screens */
            padding-top: 12rem; 
        }
        
        @media (max-width: 1023px) { /* Adjust padding for medium screens */
            body {
                padding-top: 10rem;
            }
        }

        @media (max-width: 767px) { /* Adjust padding for small screens */
            body {
                padding-top: 8rem;
            }
        }

        /* Style for the button row */
        .icon-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            color: #ffffff;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
            text-align: center;
            font-weight: 500;
        }

        .icon-button:hover {
            background-color: #3b82f6;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            transition: opacity 0.2s ease-in-out;
        }
        
        /* --- Modal Pop-up Styles --- */
        /* The main change to the modal is removing the centering transform */
        .modal {
            position: absolute; /* Positioned relative to the main-content container */
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 400px;
            max-width: 90vw;
            max-height: 90vh;
            resize: both; /* Allows user to resize the modal */
        }

        .modal-header {
            padding: 10px 15px;
            background-color: #4f46e5; /* indigo-600 */
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: grab;
        }

        .modal-body {
            padding: 15px;
            overflow-y: auto; /* Allows content to scroll */
            flex-grow: 1;
        }

        .modal-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex flex-col min-h-screen">
        <header class="bg-blue-500 shadow-md">
            <div class="header-content">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-2">
                    <div class="flex items-center mb-2 sm:mb-0">
                        <img src="https://placehold.co/40x40/5d8cfd/fff?text=Logo" alt="img" class="h-5 w-5 mr-2 rounded-full shadow-md">
                        <span class="font-bold text-md tracking-tight text-white whitespace-nowrap">DuroPOS *GLOBAL MAKE TRADERS LTD*</span>
                        <span id="current-date" class="ml-4 text-white text-xs opacity-75 hidden sm:inline"></span>
                    </div>
                    <div class="text-sm flex items-center space-x-2 w-full sm:w-auto justify-between">
                        <span class="text-white whitespace-nowrap">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                    </div>
                </div>
            
                <div class="flex-grow flex-wrap lg:flex-nowrap lg:flex lg:items-center lg:w-auto p-2 border-t border-blue-400">
                    <nav class="text-sm flex flex-wrap lg:flex-nowrap">
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">View</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Admin</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Reports</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Masters</a>
                        <!-- FIX: Changed <a> to a <button> and wrapped it in a <div> for proper dropdown behavior. -->
                        <div class="relative inline-block text-left" id="stores-dropdown">
                            <button id="stores-button" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium focus:outline-none" aria-haspopup="true" aria-expanded="false">
                                Stores
                            </button>
                            <!-- NOTE: Replaced the group-hover logic with JS-controlled classes -->
                            <div id="stores-menu" class="dropdown-menu origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0 invisible" role="menu" aria-orientation="vertical" aria-labelledby="stores-button">
                                <a href="#direct-purchases" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"  data-content-id="direct-purchases" onclick="openStockForm(); closeDropdown('stores-menu', 'stores-button'); return false;">Direct Purchases - Stocking</a>
                                <a href="#return-inwards" class="block px-4 py-2 text-gray-800 hover:bg-blue-100" data-content-id="return-inwards">Return Inwards/Outwards</a>
                                <a href="#stock-transfers" class="block px-4 py-2 text-gray-800 hover:bg-blue-100" data-content-id="stock-transfers">Stock/Item Transfers</a>
                                <a href="#stock-adjustments" class="block px-4 py-2 text-gray-800 hover:bg-blue-100" data-content-id="stock-adjustments">Stock Count Adjustments</a>
                                <a href="#departmental-consumption" class="block px-4 py-2 text-gray-800 hover:bg-blue-100" data-content-id="departmental-consumption">Departmental Consumption Tallies</a>
                                <a href="#production-stocking" class="block px-4 py-2 text-gray-800 hover:bg-blue-100" data-content-id="production-stocking">Production Stocking/Conversion</a>
                            </div>
                        </div>
                        
                        <div class="relative inline-block text-left" id="accounts-dropdown">
                            <button id="accounts-button" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium focus:outline-none" aria-haspopup="true" aria-expanded="true">
                                Accounts
                            </button>
                            <div id="accounts-menu" class="dropdown-menu origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0 invisible" role="menu" aria-orientation="vertical" aria-labelledby="accounts-button">
                                <div class="py-1" role="none">
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" onclick="openPosForm(); closeDropdown('accounts-menu', 'accounts-button'); return false;">POS</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="openBillsFolioRegisterForm(); closeDropdown('accounts-menu', 'accounts-button'); return false;">Bills Folio Register</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Accounts Payable</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="openSalesOrderForm(); closeDropdown('accounts-menu', 'accounts-button'); return false;">Sales Orders Processing</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Invoice Payments (Receivables)</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Debit</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Cash Register</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Payment Entries</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Banking Entries</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" onclick="closeDropdown('accounts-menu', 'accounts-button'); return false;">Customer Accounts Deposit</a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">HRM</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Payroll</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Tools</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Windows</a>
                        <a href="#" class="nav-link block mt-2 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Help</a>
                    </nav>
                </div>
            
                <div class="flex flex-wrap items-center justify-between p-2 border-t border-blue-400">
                    <div class="flex flex-wrap items-center space-x-2">
                        <button class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            <span class="text-xs">Save</span>
                        </button>
                        <button class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 4v6m-4-3h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m-6-6h12a2 2 0 002-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs">Copy</span>
                        </button>
                        <button class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2v-4m-2 4h2m0 0v1a2 2 0 01-2 2h-4a2 2 0 01-2-2v-1M17 17h-4m-4-4h4m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-xs">Print</span>
                        </button>
                        <button class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <span class="text-xs">Find Record</span>
                        </button>
                        <a href="#" class="icon-button">
                            <span class="text-xs">Drawer Reconciliation</span>
                        </a>
                        <a href="#" class="icon-button">
                            <span class="text-xs">Admin Collection</span>
                        </a>
                        <a href="#" id="pos-button" class="icon-button" onclick="openPosForm(); return false;">POS</a>
                    </div>
                    <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                        <a href="logout.php" class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H3a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-xs">Exit</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow p-6 relative" id="main-content">
            <!-- This is the container for the cascading modals -->
            <div id="modal-container" class="absolute inset-0 z-10"></div>
            
            <div class="text-center text-gray-500" id="initial-message">
                <h2 class="text-2xl font-semibold mb-4">Welcome to DuroPOS</h2>
                <p>Select an option from the navigation bar above to get started.</p>
            </div>
        </main>
        
        <footer class="bg-gray-800 text-white p-4 text-sm">
            <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between">
                <span id="open-windows-count" class="text-xs opacity-75 order-3 sm:order-2 mt-2 sm:mt-0">
                    Open Windows: 0
                </span>
                <span class="text-center text-xs order-2 sm:order-1 mt-2 sm:mt-0">
                    &copy; <span id="current-year"></span> Global Make Traders LTD. All rights reserved.
                </span>
                <span class="text-xs opacity-75 order-1 sm:order-2">User : <?php echo htmlspecialchars($username); ?></span>
            </div>
        </footer>
    </div>

    <script>
        // --- Core Application Logic ---

        // Tracks the number of open modals for the cascade effect
        let openModalCount = 0;
        let zIndexCounter = 100;
        const cascadeOffset = 30; // pixels for each new modal

        /**
         * Updates the display of the number of open windows.
         */
        function updateModalCountDisplay() {
            const countElement = document.getElementById('open-windows-count');
            if (countElement) {
                countElement.textContent = `Open Windows: ${openModalCount}`;
            }
        }
        
        /**
         * Closes a specific modal by its ID.
         * @param {string} modalId - The ID of the modal to close.
         */
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.remove();
                // Decrement the open modal count
                openModalCount--;
                if (openModalCount < 0) openModalCount = 0; // Prevent negative numbers
                updateModalCountDisplay();
            }
        }

        /**
         * Fetches a form from a specified URL and creates a new modal pop-up.
         * The new modal will be positioned in a cascading manner.
         * @param {string} formUrl - The URL of the form to fetch.
         * @param {string} modalTitle - The title for the modal window.
         */
        function openForm(formUrl, modalTitle) {
            const modalId = `modal-${Date.now()}`;
            
            // Increment the count and z-index for the new modal
            openModalCount++;
            zIndexCounter++;

            // Hide the initial message if this is the first modal
            const initialMessage = document.getElementById('initial-message');
            if (initialMessage) {
                initialMessage.style.display = 'none';
            }

            // Create the modal container
            const modal = document.createElement('div');
            modal.id = modalId;
            modal.classList.add('modal');
            modal.style.zIndex = zIndexCounter;

            // Set the form's initial position in a cascading manner
            const topOffset = openModalCount * cascadeOffset;
            const leftOffset = openModalCount * cascadeOffset;
            modal.style.top = `${topOffset}px`;
            modal.style.left = `${leftOffset}px`;

            // Add an event listener to bring the modal to the front when clicked
            modal.addEventListener('mousedown', () => {
                zIndexCounter++;
                modal.style.zIndex = zIndexCounter;
            });
            
            // Add a loading message
            modal.innerHTML = `
                <div class="modal-header">
                    <span>${modalTitle}</span>
                    <button class="modal-close-btn" onclick="closeModal('${modalId}')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="p-4 text-center text-gray-500 animate-pulse">Loading form...</div>
                </div>
            `;
            
            // Append the new modal to the modal-container
            const modalContainer = document.getElementById('modal-container');
            if (modalContainer) {
                modalContainer.appendChild(modal);
            } else {
                console.error("Error: modal-container not found.");
                return;
            }

            // Fetch the content of the form and inject it into the modal body
            fetch(formUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Failed to fetch form. Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    const modalBody = modal.querySelector('.modal-body');
                    modalBody.innerHTML = html;
                    
                    // Re-apply the drag functionality to the new modal's header
                    const header = modal.querySelector('.modal-header');
                    let isDragging = false;
                    let initialX, initialY, currentX, currentY;
                    let modalLeft = leftOffset;
                    let modalTop = topOffset;

                    header.addEventListener('mousedown', dragStart);
                    
                    function dragStart(e) {
                        initialX = e.clientX;
                        initialY = e.clientY;
                        isDragging = true;
                        document.addEventListener('mousemove', drag);
                        document.addEventListener('mouseup', dragEnd);
                    }

                    function drag(e) {
                        if (isDragging) {
                            e.preventDefault();
                            currentX = e.clientX - initialX;
                            currentY = e.clientY - initialY;
                            
                            // Update modal's position
                            modal.style.left = `${modalLeft + currentX}px`;
                            modal.style.top = `${modalTop + currentY}px`;
                        }
                    }

                    function dragEnd(e) {
                        isDragging = false;
                        // Update the new permanent position for the next drag operation
                        modalLeft = parseInt(modal.style.left);
                        modalTop = parseInt(modal.style.top);
                        
                        document.removeEventListener('mousemove', drag);
                        document.removeEventListener('mouseup', dragEnd);
                    }
                })
                .catch(error => {
                    console.error('Error loading form:', error);
                    const modalBody = modal.querySelector('.modal-body');
                    modalBody.innerHTML = `
                        <div class="p-4 text-red-500 text-center">
                            <p>Error: Could not load the form. Check the console for details.</p>
                        </div>
                    `;
                });
            
            updateModalCountDisplay();
        }

        /**
         * Opens the POS form in a new modal.
         */
        function openPosForm() {
            openForm('assets/pos-form.php', 'Point of Sale (POS)');
        }

        /**
         * Opens the Bills Folio Register form in a new modal.
         */
        function openBillsFolioRegisterForm() {
            openForm('assets/bills_folio.php', 'Bills Folio Register');
        }

        /**
         * Opens the Sales Order Processing form in a new modal.
         */
        function openSalesOrderForm() {
            openForm('assets/sales_order.php', 'Sales Orders Processing');
        }
        
         /**
         * Opens the Stocking form in a new modal.
         */
        function openStockForm() {
            openForm('assets/stock.php', 'Stock');
        }
        
        /**
         * Toggles the visibility of a dropdown menu.
         * @param {string} menuId - The ID of the menu element.
         * @param {string} buttonId - The ID of the button element.
         */
        function toggleDropdown(menuId, buttonId) {
            const menu = document.getElementById(menuId);
            const button = document.getElementById(buttonId);
            const isVisible = menu.classList.contains('visible');
            
            if (isVisible) {
                closeDropdown(menuId, buttonId);
            } else {
                menu.classList.add('visible');
                menu.classList.remove('invisible', 'opacity-0');
                button.setAttribute('aria-expanded', 'true');
            }
        }

        /**
         * Hides a specific dropdown menu.
         * @param {string} menuId - The ID of the menu element to hide.
         * @param {string} buttonId - The ID of the button element to update.
         */
        function closeDropdown(menuId, buttonId) {
            const menu = document.getElementById(menuId);
            const button = document.getElementById(buttonId);
            menu.classList.remove('visible');
            menu.classList.add('invisible', 'opacity-0');
            button.setAttribute('aria-expanded', 'false');
        }


        // --- Dynamic Date Logic & Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown logic for both Stores and Accounts
            const dropdowns = [
                { id: 'stores-dropdown', buttonId: 'stores-button', menuId: 'stores-menu' },
                { id: 'accounts-dropdown', buttonId: 'accounts-button', menuId: 'accounts-menu' }
            ];

            dropdowns.forEach(dropdown => {
                const button = document.getElementById(dropdown.buttonId);
                const menu = document.getElementById(dropdown.menuId);
                const dropdownContainer = document.getElementById(dropdown.id);

                if (button && menu && dropdownContainer) {
                    // Toggle the menu when the button is clicked
                    button.addEventListener('click', function(event) {
                        event.stopPropagation();
                        // Close other open dropdowns before opening this one
                        dropdowns.forEach(otherDropdown => {
                            if (otherDropdown.id !== dropdown.id) {
                                closeDropdown(otherDropdown.menuId, otherDropdown.buttonId);
                            }
                        });
                        toggleDropdown(dropdown.menuId, dropdown.buttonId);
                    });

                    // Close the dropdown if the user clicks anywhere else
                    document.addEventListener('click', function(event) {
                        if (!dropdownContainer.contains(event.target)) {
                            closeDropdown(dropdown.menuId, dropdown.buttonId);
                        }
                    });
                }
            });

            // Dynamic Date Logic
            const updateDate = () => {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const formattedDate = now.toLocaleDateString('en-US', options);
                
                const dateElement = document.getElementById('current-date');
                if (dateElement) {
                    dateElement.textContent = ` ${formattedDate}`;
                }

                const yearElement = document.getElementById('current-year');
                if (yearElement) {
                    yearElement.textContent = now.getFullYear();
                }
            };

            updateDate(); // Call the function on page load
            setInterval(updateDate, 60000); // Update the date every minute
        });
    </script>
</body>
</html>
