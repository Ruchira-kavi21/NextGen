<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen Coumputing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-black">
    <div class="text-white  ml-5 mt-7   ">
        <a href="/profile"class=" text-gray-300 hover:text-blue-500 hover:bg-gray-700 p-2 rounded-md transition-colors duration-200 font-semibold  ">  Edit Profile</a>
    </div>
    <div class="container mx-auto p-6 max-w-3xl">
        <h1 class="text-3xl font-bold text-center mb-6 text-white">Edit Your Profile</h1>

        <form action="/submit-profile" method="POST" enctype="multipart/form-data" class="space-y-6 text-white">
            <div class="flex justify-center items-center space-x-4">
                <div class="w-24 h-24 rounded-full bg-gray-700 flex justify-center items-center">
                    <!-- <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)" class="opacity-0 absolute w-full h-full" />
                    <img id="profile-preview" src="#" alt="Profile Picture Preview" class="w-20 h-20 object-cover rounded-full hidden" /> -->
                    <span class="text-gray-400">No Picture</span>
                </div>
            </div>

            <div>
                <label for="first_name" class="block text-lg font-medium">First Name</label>
                <input type="text" id="first_name" name="first_name" value="" placeholder="Enter your first name" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="last_name" class="block text-lg font-medium">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="" placeholder="Enter your last name" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="address" class="block text-lg font-medium">Delivery Address</label>
                <textarea id="address" name="address" placeholder="Enter your delivery address" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label for="zip_code" class="block text-lg font-medium">Zip Code</label>
                <input type="text" id="zip_code" name="zip_code" value="" placeholder="Enter your zip code" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="mobile_number" class="block text-lg font-medium">Mobile Number</label>
                <input type="tel" id="mobile_number" name="mobile_number" value="" placeholder="Enter your mobile number" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="optional_mobile_number" class="block text-lg font-medium">Optional Mobile Number</label>
                <input type="tel" id="optional_mobile_number" name="optional_mobile_number" value="" placeholder="Enter optional mobile number" class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="email" class="block text-lg font-medium">Email</label>
                <input type="email" id="email" name="email" value="" placeholder="Enter your email" required class="w-full mt-2 p-3 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" class="py-2 px-6 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">Save Changes</button>
                <button type="button" class="py-2 px-6 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-all" onclick="window.location.href='/profile'">Cancel</button>
            </div>
        </form>
    </div>

    <!-- <script>
        // Preview profile picture before uploading
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('profile-preview');
                output.src = reader.result;
                output.style.display = 'block'; // Show preview
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>