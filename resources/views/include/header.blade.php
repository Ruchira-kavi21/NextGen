<nav class="shadow-md text-white">
    <div class="max-w-screen-xl mx-auto px-4 py-2.5">
        <div class="flex items-center justify-between">
            <a class="text-2xl font-bold" href="/index">NextGen Coumputing</a>

            <button class="lg:hidden p-2 hover:bg-gray-950 rounded-md focus:outline-none" aria-controls="navbarNav" aria-expanded="false" id="navbar-toggle">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5h18a1 1 0 011 1v2a1 1 0 01-1 1H3a1 1 0 01-1-1V6a1 1 0 011-1zM3 12h18a1 1 0 011 1v2a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 011-1zM3 19h18a1 1 0 011 1v2a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 011-1z"></path>
                </svg>
            </button>

            <div class="hidden lg:flex space-x-8">
                <a class="hover:text-blue-500" href="/index">Home</a>
                <a class="hover:text-blue-500" href="#">Components</a>
                <a class="hover:text-blue-500" href="#">Market</a>

                <div class="relative group">
                    <button class="hover:text-blue-500 flex items-center">Profile Management
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 9l6 6 6-6"></path>
                        </svg>
                    </button>
                    
                    <div class="absolute hidden bg-gray-900 shadow-md rounded-lg mt-2 w-48 group-hover:block">
                        <a class="block px-4 py-2 hover:bg-gray-950" href="/login">Login</a>
                        <a class="block px-4 py-2 hover:bg-gray-950" href="/login">Logout</a>
                        <a class="block px-4 py-2 hover:bg-gray-950" href="/profile">Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:hidden collapse" id="navbarNav">
        <ul class="space-y-4">
            <li><a class="block py-2 px-4 hover:bg-gray-950" href="#">Home</a></li>
            <li><a class="block py-2 px-4 hover:bg-gray-950" href="#">Components</a></li>
            <li><a class="block py-2 px-4 hover:bg-gray-950" href="#">Market</a></li>
            <li class="relative">
            <button class="hover:text-blue-500 w-full flex items-center justify-between">
                Profile Management
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 9l6 6 6-6"></path>
                </svg>
            </button>
            <div class="absolute hidden bg-gray-900 shadow-md rounded-lg mt-2 w-48">
                <a class="block px-4 py-2 hover:bg-gray-950" href="/login">Login</a>
                <a class="block px-4 py-2 hover:bg-gray-950" href="#">Logout</a>
                <a class="block px-4 py-2 hover:bg-gray-950" href="#">Profile</a>
            </div>
            </li>
        </ul>
        </div>
    </div>
</nav>
<script>
const toggleButton = document.getElementById('navbar-toggle');
const navbarMenu = document.getElementById('navbarNav');

toggleButton.addEventListener('click', () => {
    navbarMenu.classList.toggle('collapse');
});

const dropdownButton = document.querySelectorAll('.relative');
dropdownButton.forEach(button => {
    button.addEventListener('click', () => {
    const dropdownMenu = button.querySelector('div');
    dropdownMenu.classList.toggle('hidden');
    });
});
</script>