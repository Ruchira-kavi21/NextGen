<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell a Part</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            background: transparent !important;
            border: none !important;
            border-bottom: 1px solid white !important;
            color: white !important;
            outline: none !important;
            width: 100% !important;
        }

        input[type="text"]::placeholder,
        input[type="number"]::placeholder,
        textarea::placeholder {
            color: #a0aec0 !important;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Header with Back Button -->
    <header class="bg-gray-900 p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ route('secondhand.index') }}" class="text-white hover:text-gray-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="text-sm text-gray-400">NEXTGEN COMPUTING</div>
        </div>
        <h1 class="text-2xl font-bold">Second-hand Market</h1>
        <div class="text-2xl">
            <i class="fas fa-user-circle"></i>
        </div>
    </header>
    <div class="w-full h-1 bg-red-600"></div>

    <div class="min-h-screen bg-gray-900 p-6 flex items-center justify-center">
        <div class="w-full max-w-2xl">
            <!-- Form Heading -->
            <h3 class="text-xl font-semibold text-white mb-6 text-center">Sell a Part</h3>

            <!-- Display Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Sell Form -->
            <form action="{{ route('secondhand.sell.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Part Name -->
                <div class="mb-6">
                    <label for="part_name" class="block text-white font-semibold mb-1">Part Name</label>
                    <input type="text" name="part_name" id="part_name" class="p-2 @error('part_name') border-red-500 @enderror" value="{{ old('part_name') }}" placeholder="e.g., Graphics Card" required>
                    @error('part_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-white font-semibold mb-1">Description</label>
                    <textarea name="description" id="description" class="p-2 @error('description') border-red-500 @enderror" rows="4" placeholder="e.g., NVIDIA GTX 1080, used for 2 years, good condition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-white font-semibold mb-1">Price (LKR)</label>
                    <input type="number" name="price" id="price" step="0.01" class="p-2 @error('price') border-red-500 @enderror" value="{{ old('price') }}" placeholder="e.g., 15000.00" required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image 1 -->
                <div class="mb-6">
                    <label for="image1" class="block text-white font-semibold mb-1">Image 1 (Optional)</label>
                    <input type="file" name="image1" id="image1" class="p-2 @error('image1') border-red-500 @enderror">
                    @error('image1')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image 2 -->
                <div class="mb-6">
                    <label for="image2" class="block text-white font-semibold mb-1">Image 2 (Optional)</label>
                    <input type="file" name="image2" id="image2" class="p-2 @error('image2') border-red-500 @enderror">
                    @error('image2')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image 3 -->
                <div class="mb-6">
                    <label for="image3" class="block text-white font-semibold mb-1">Image 3 (Optional)</label>
                    <input type="file" name="image3" id="image3" class="p-2 @error('image3') border-red-500 @enderror">
                    @error('image3')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-full">Submit for Review</button>
                </div>
            </form>
        </div>
    </div>
    @include('include.footer')

</body>
</html>