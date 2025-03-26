<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Second-Hand Part</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-900 text-white">
    @include('include.header')

    <div class="min-h-screen bg-gray-900 p-6">
        <div class="text-center text-white mb-6">
            <h2 class="text-4xl font-bold">List a Second-Hand Part</h2>
        </div>

        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('secondhand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="part_name" class="block text-gray-700 font-bold mb-2">Part Name</label>
                    <input type="text" name="part_name" id="part_name" class="w-full p-3 rounded-lg border border-gray-300" value="{{ old('part_name') }}" required>
                    @error('part_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="seller_id" class="block text-gray-700 font-bold mb-2">Seller</label>
                    <select name="seller_id" id="seller_id" class="w-full p-3 rounded-lg border border-gray-300" required>
                        <option value="">Select a Seller</option>
                        @foreach (\App\Models\Seller::all() as $seller)
                            <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>
                                {{ $seller->first_name . ' ' . $seller->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('seller_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price (LKR)</label>
                    <input type="number" name="price" id="price" class="w-full p-3 rounded-lg border border-gray-300" value="{{ old('price') }}" step="0.01" required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                    <select name="status" id="status" class="w-full p-3 rounded-lg border border-gray-300" required>
                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Sold" {{ old('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="condition" class="block text-gray-700 font-bold mb-2">Condition</label>
                    <select name="condition" id="condition" class="w-full p-3 rounded-lg border border-gray-300">
                        <option value="New" {{ old('condition') == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Used" {{ old('condition') == 'Used' ? 'selected' : '' }}>Used</option>
                    </select>
                    @error('condition')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description" id="description" class="w-full p-3 rounded-lg border border-gray-300" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image1" class="block text-gray-700 font-bold mb-2">Image 1</label>
                    <input type="file" name="image1" id="image1" class="w-full p-3 rounded-lg border border-gray-300">
                    @error('image1')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image2" class="block text-gray-700 font-bold mb-2">Image 2</label>
                    <input type="file" name="image2" id="image2" class="w-full p-3 rounded-lg border border-gray-300">
                    @error('image2')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image3" class="block text-gray-700 font-bold mb-2">Image 3</label>
                    <input type="file" name="image3" id="image3" class="w-full p-3 rounded-lg border border-gray-300">
                    @error('image3')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                    <input type="text" name="category" id="category" class="w-full p-3 rounded-lg border border-gray-300" value="{{ old('category') }}">
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">List Part</button>
                    <a href="{{ route('secondhand.index') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    @include('include.footer')
</body>
</html>