@extends('layouts')
@section('title', 'SignUp')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div class="p-8 rounded-xl  w-full md:w-4/5 lg:w-1/2 xl:w-2/3">
            <h2 class="text-4xl font-bold mb-6 text-white">Create Your Account</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col bg-gray-200 rounded-3xl p-6">
                    <h3 class="text-lg font-semibold mb-4">Sign Up</h3>
                    <form action="#" method="POST">
                        <label for="name" class="block text-sm">Name *</label>
                        <input type="text" id="name" name="name" class="w-full p-3 mb-4 bg-white text-white rounded-md" placeholder="Your Name" required>
                        
                        <label for="email" class="block text-sm">Email *</label>
                        <input type="email" id="email" name="email" class="w-full p-3 mb-4 bg-white text-white rounded-md" placeholder="Your Email" required>
                        
                        <label for="password" class="block text-sm">Password *</label>
                        <input type="password" id="password" name="password" class="w-full p-3 mb-4 bg-white text-white rounded-md" placeholder="Your Password" required>
                        
                        <label for="confirm_password" class="block text-sm">Confirm Password *</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="w-full p-3 mb-4 bg-white text-white rounded-md" placeholder="Confirm Your Password" required>

                        <div class="flex justify-between items-center mb-4">
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors duration-200">Sign Up</button>
                        </div>
                    </form>
                </div>

                <div class="flex flex-col bg-gray-200 rounded-3xl p-6">
                    <h3 class="text-lg font-semibold mb-4">Why Create An Account?</h3>
                    <p class="mb-4">Creating an account has many benefits:</p>
                    <ul class="list-disc pl-6 mb-4 text-sm">
                        <li>Check out faster</li>
                        <li>Keep more than one address</li>
                        <li>Track orders and more</li>
                    </ul>
                    <a href="/login" class="text-center block text-white bg-red-600 py-2 rounded-md hover:bg-red-700 transition-colors duration-200">Already have an account? Sign In</a>
                </div>
            </div>
        </div>
    </div>
@endsection