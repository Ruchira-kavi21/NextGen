<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation - NextGen Computing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #0d1117 0%, #1a202c 100%);
            color: #e2e8f0;
        }
        .header {
            background: #161b22;
            border-bottom: 2px solid #e53e3e;
            box-shadow: 0 0 15px rgba(229, 62, 62, 0.3);
        }
        .header h1 {
            font-family: 'Orbitron', sans-serif;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(229, 62, 62, 0.5);
        }
        .card {
            background: #1f252d;
            border: 1px solid #2d3748;
            border-radius: 0.75rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background: #e53e3e;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(229, 62, 62, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #c53030;
            box-shadow: 0 0 15px rgba(229, 62, 62, 0.5);
        }
        .text-primary {
            color: #e53e3e;
        }
    </style>
</head>
<body>
    <header class="header p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ route('secondhand.index') }}" class="text-white hover:text-gray-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="text-sm text-gray-400">NEXTGEN COMPUTING</div>
        </div>
        <h1 class="text-2xl font-bold">Payment Confirmation</h1>
        <div class="text-2xl">
            <i class="fas fa-user-circle text-primary"></i>
        </div>
    </header>

    <div class="min-h-screen p-6 flex items-center justify-center">
        <div class="w-full max-w-2xl">
            <div class="card p-8">
                <h3 class="text-xl font-semibold mb-6 text-center text-primary">Thank You for Your Purchase!</h3>
                <div class="text-gray-300">
                    <p><strong>Part:</strong> {{ $part->part_name }}</p>
                    <p><strong>Price:</strong> LKR {{ number_format($order->component_price, 2) }}</p>
                    <p><strong>Total Cost:</strong> LKR {{ number_format($order->total, 2) }}</p>
                    <p><strong>Transaction ID:</strong> {{ $order->stripe_payment_id }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="mt-4">Your purchase has been completed successfully. You will receive a confirmation email shortly.</p>
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('secondhand.index') }}" class="btn-primary text-white py-2 px-6 rounded-full">Back to Market</a>
                </div>
            </div>
        </div>
    </div>

    @include('include.footer')
</body>
</html>