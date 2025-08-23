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

        /* Custom styles for the draggable popup */
        .draggable-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Ensure it's on top of other content */
            max-width: 90%;
            max-height: 90vh;
            overflow: auto;
            cursor: move; /* Change cursor to indicate it's draggable */
        }

        .no-drag {
            cursor: auto; /* Revert cursor for non-draggable elements inside the popup */
        }
        
        /* The key change: fix the header and add padding to the body */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50; /* Ensure it's above other content but below popups */
        }
        
        body {
            /* Adjust padding to accommodate the new three-line header */
            padding-top: 12rem; 
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
        }

        .icon-button:hover {
            background-color: #3b82f6;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            transition: opacity 0.2s ease-in-out;
        }
        
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex flex-col min-h-screen">
        <header class="bg-blue-500 shadow-md">
            <!-- First Line: DuroPOS Title -->
            <div class="flex justify-between items-center p-2">
                 <div class="flex items-center">
                <img src="https://placehold.co/40x40/5d8cfd/fff?text=Logo" alt="img" class="h-5 w-5 mr-2 rounded-full shadow-md">
                <span class="font-bold text-md tracking-tight text-white">DuroPOS *GLOBAL MAKE TRADERS LTD*</span>
                <span id="current-date" class="ml-4 text-white text-xs opacity-75"></span>
                 </div>
                <div class="text-sm flex items-center space-x-2">
                    <span class="text-white">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                    <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-blue-600 border-white bg-blue-100 hover:border-transparent hover:text-blue-500 hover:bg-white transition-colors duration-200 font-extrabold shadow-md transform hover:scale-105" onclick="openPosForm(); return false;">POS</a>
                  
                </div>
            </div>

            <!-- Second Line: Navigation Links -->
            <div class="flex-grow flex-wrap lg:flex-nowrap lg:flex lg:items-center lg:w-auto p-2">
                <nav class="text-sm flex flex-wrap lg:flex-nowrap">
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">View</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Admin</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Reports</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Masters</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Stores</a>

                    <!-- Accounts Dropdown Menu -->
                    <div class="relative inline-block text-left" id="accounts-dropdown">
                        <button id="accounts-button" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium focus:outline-none" aria-haspopup="true" aria-expanded="true">
                            Accounts
                        </button>
                        <div id="accounts-menu" class="dropdown-menu origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0 invisible" role="menu" aria-orientation="vertical" aria-labelledby="accounts-button">
                            <div class="py-1" role="none">
                                <a href="assets/pos-form.php" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"onclick="openPosForm(); return false;">POS</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Bills Folio Register</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Accounts Payable</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Sales Orders Processing</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Invoice Payments (Receivables)</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Debit</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Cash Register</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Payment Entries</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Banking Entries</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Customer Accounts Deposit</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="pos-form.php" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">HRM</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Payroll</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Tools</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Windows</a>
                    <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Help</a>
                    
                </nav>
            </div>

            <!-- Third Line: Action Buttons -->
            <div class="flex justify-start p-2 border-t border-blue-500">
                <div class="flex items-center space-x-2">
                    <!-- Save Button -->
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span class="text-xs">Save</span>
                    </button>
                    <!-- Copy Button -->
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 4v6m-4-3h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2m-6-6h12a2 2 0 002-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs">Copy</span>
                    </button>
                    <!-- Print Button -->
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2v-4m-2 4h2m0 0v1a2 2 0 01-2 2h-4a2 2 0 01-2-2v-1M17 17h-4m-4-4h4m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-xs">Print</span>
                    </button>
                    <!-- Find (Binoculars) Button -->
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        <span class="text-xs">Find Record</span>
                    </button>
                    <!-- Drawer Reconciliation Button -->
                   <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Drawer Reconcilliation</a>                   
                   <a href="#" class="nav-link block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4 p-2 rounded-md font-medium">Admin Collection</a>
                </div>
                  <div class="flex items-center space-x-2">
                   <a href="logout.php" class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H3a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-xs">Exit</span>
                    </a>
                </div>
            </div>
        </header>

        <main class="flex-grow p-6">
            <div class="container mx-auto">
                <!-- Main content goes here -->
            </div>
        </main>

        <!-- Updated Footer -->
        <footer class="bg-gray-800 text-white p-4 text-sm">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Copyright in the center -->
               <span class="text-center text-xs">
                    &copy; <span id="current-year"></span> Global Make Traders LTD. All rights reserved.
                </span>
                <!-- User/Department on the right -->
                <span class="text-xs opacity-75">User : <?php echo htmlspecialchars($username); ?></span>
            </div>
        </footer>
    </div>

    <script>
        // --- Core Application Logic ---

        /**
         * Loads the content of 'pos-form.php' into the main content area of the page.
         */
        function loadPosFormIntoMain() {
            const mainContent = document.getElementById('main-content');
            
            // Display a loading message while fetching the form
            mainContent.innerHTML = `
                <div class="container mx-auto flex items-center justify-center h-full">
                    <p class="text-center text-gray-500 animate-pulse">Loading POS form...</p>
                </div>
            `;
            
            // Fetch the content of the form and inject it into the main content area
            fetch('assets/pos-form.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch POS form');
                    }
                    return response.text();
                })
                .then(html => {
                    // Inject the HTML directly into the main content area
                    mainContent.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading POS form:', error);
                    mainContent.innerHTML = `
                        <div class="container mx-auto flex items-center justify-center h-full">
                            <p class="text-red-500 text-center">Error: Could not load the form. Check the console for details.</p>
                        </div>
                    `;
                });
        }
        
        // --- Dropdown Menu Logic ---
        document.addEventListener('DOMContentLoaded', function() {
            const accountsButton = document.getElementById('accounts-button');
            const accountsMenu = document.getElementById('accounts-menu');
            const accountsDropdown = document.getElementById('accounts-dropdown');

            // Function to show/hide the menu
            const toggleMenu = () => {
                const isVisible = accountsMenu.classList.contains('visible');
                if (isVisible) {
                    // Hide the menu
                    accountsMenu.classList.remove('visible');
                    accountsMenu.classList.add('invisible', 'opacity-0');
                    accountsButton.setAttribute('aria-expanded', 'false');
                } else {
                    // Show the menu
                    accountsMenu.classList.add('visible');
                    accountsMenu.classList.remove('invisible', 'opacity-0');
                    accountsButton.setAttribute('aria-expanded', 'true');
                }
            };

            // Toggle the menu when the button is clicked
            accountsButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the click from bubbling up to the document
                toggleMenu();
            });

            // Close the dropdown if the user clicks anywhere else
            document.addEventListener('click', function(event) {
                if (!accountsDropdown.contains(event.target) && accountsMenu.classList.contains('visible')) {
                    toggleMenu();
                }
            });

            // --- Dynamic Date Logic ---
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
