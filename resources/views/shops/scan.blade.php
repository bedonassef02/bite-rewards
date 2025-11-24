<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Scan Customer QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="reader" width="600px" class="mx-auto bg-black rounded-lg overflow-hidden"></div>
                    
                    <div id="result" class="mt-4 text-center hidden">
                        <div class="p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
                            <h3 class="font-bold text-lg">Scan Successful!</h3>
                            <p id="result-message"></p>
                        </div>
                    </div>

                    <div id="error" class="mt-4 text-center hidden">
                        <div class="p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
                            <h3 class="font-bold text-lg">Error</h3>
                            <p id="error-message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HTML5-QRCode Library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            
            // Stop scanning temporarily
            html5QrcodeScanner.clear();

            // Send to backend
            fetch('{{ route('visits.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    shop_id: {{ $shop->id }},
                    customer_id: decodedText // Assuming QR contains just the ID
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('result').classList.remove('hidden');
                    document.getElementById('result-message').innerText = `Visit recorded! Total: ${data.total_visits}. Reward Earned: ${data.reward_earned ? 'YES!' : 'No'}`;
                    
                    // Restart scanner after 3 seconds
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    document.getElementById('error').classList.remove('hidden');
                    document.getElementById('error-message').innerText = data.message || 'Something went wrong';
                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById('error').classList.remove('hidden');
                document.getElementById('error-message').innerText = 'Network error';
            });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</x-app-layout>
