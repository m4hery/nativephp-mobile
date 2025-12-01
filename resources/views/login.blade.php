<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gray-100 flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-5xl grid grid-cols-1 gap-8">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-200 p-8 md:p-10 flex flex-col justify-center">

            <div class="mb-6 md:mb-8 flex items-center gap-3">
                {{-- <div class="w-9 h-9 rounded-full bg-red-600 flex items-center justify-center">
                    <div class="relative w-4 h-4">
                        <span class="absolute inset-y-0 left-1/2 w-0.5 -translate-x-1/2 bg-white rounded"></span>
                        <span class="absolute inset-x-0 top-1/2 h-0.5 -translate-y-1/2 bg-white rounded"></span>
                    </div>
                </div> --}}
                <img src="{{ asset('icon.png') }}" alt="Logo Croix-Rouge"
                    class="w-9 h-9 rounded-full bg-white border-red-600 border-2 flex items-center justify-center">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Espace sécurisé</p>
                    <p class="font-semibold text-gray-900 text-sm">Croix-Rouge</p>

                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
                <p class="mt-1 text-sm text-gray-600">Entrez vos identifiants pour continuer.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 text-sm text-red-700 px-4 py-3">
                    <p class="font-semibold mb-1">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Login</label>
                    <input type="text" name="login" required
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900
                               focus:ring-2 focus:ring-red-600 focus:border-red-600"
                        placeholder="JDoess">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" required
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900
                               focus:ring-2 focus:ring-red-600 focus:border-red-600"
                        placeholder="••••••••">
                </div>

                {{-- Options --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-700">
                        <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-600">
                        Se souvenir de moi
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-red-600 hover:text-red-700 font-medium">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                {{-- Bouton --}}
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">
                    Se connecter
                </button>
            </form>
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500 transition-colors duration-300"
                            id="statusIndicator"></div>
                        <p class="text-sm text-gray-600 transition-colors duration-300" id="statusConnexion">
                            Vérification de la connexion...
                        </p>
                    </div>
                    <button type="button" id="syncButton"
                        class="flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 font-medium transition-colors duration-200 px-3 py-1.5 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-4 h-4 transition-transform duration-300" id="syncIcon" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span id="syncText">Synchroniser</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const statusConnexion = document.getElementById('statusConnexion');
        const statusIndicator = document.getElementById('statusIndicator');
        const syncButton = document.getElementById('syncButton');
        const syncIcon = document.getElementById('syncIcon');
        const syncText = document.getElementById('syncText');

        function updateConnectionStatus() {
            if (navigator.onLine) {
                statusConnexion.textContent = "En ligne";
                statusConnexion.className = "text-sm text-green-600 transition-colors duration-300";
                statusIndicator.className = "w-2 h-2 rounded-full bg-green-500 transition-colors duration-300";
                syncButton.disabled = false;
            } else {
                statusConnexion.textContent = "Hors ligne";
                statusConnexion.className = "text-sm text-red-600 transition-colors duration-300";
                statusIndicator.className = "w-2 h-2 rounded-full bg-red-500 transition-colors duration-300";
                syncButton.disabled = true;
            }
        }

        function performSync() {
            if (!navigator.onLine) return;

            // Afficher le loader full-screen
            showLoader();

            syncIcon.style.transform = 'rotate(360deg)';
            syncText.textContent = 'Synchronisation...';
            syncButton.disabled = true;

            // Appel à la route Laravel
            fetch('{{ route('syncronisation.users') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    hideLoader();
                    syncIcon.style.transform = 'rotate(0deg)';
                    syncText.textContent = 'Synchroniser';
                    syncButton.disabled = false;

                    // Afficher un message de succès
                    showNotification(data.message, 'success');
                    // document.getElementById('sectionRetour').textContent = data.message;
                })
                .catch(error => {
                    hideLoader();
                    syncIcon.style.transform = 'rotate(0deg)';
                    syncText.textContent = 'Synchroniser';
                    syncButton.disabled = false;
                    // Afficher un message d'erreur
                    showNotification(error.message || 'Erreur lors de la synchronisationsss', 'error');
                    console.error('Erreur:', error);

                });
        }

        function showLoader() {
            const loader = document.createElement('div');
            loader.id = 'fullScreenLoader';
            loader.innerHTML = `
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-white bg-opacity-50 backdrop-blur-sm">
                    <div class="bg-white-700 rounded-2xl p-8 shadow-2xl max-w-sm mx-4 text-center">
                        <div class="mb-4">
                            <div class="w-16 h-16 mx-auto rounded-full border-4 border-red-600 border-t-transparent animate-spin"></div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Synchronisation en cours</h3>
                        <p class="text-sm text-gray-600">Veuillez patienter pendant la synchronisation des données...</p>
                        <div class="mt-4 flex justify-center">
                            <div class="flex space-x-1">
                                <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                                <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                                <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(loader);
        }

        function hideLoader() {
            const loader = document.getElementById('fullScreenLoader');
            if (loader) {
                loader.remove();
            }
        }

        function showNotification(message, type) {
            // Supprimer toute notification existante
            const existingNotification = document.getElementById('customNotification');
            if (existingNotification) {
                existingNotification.remove();
            }

            const notification = document.createElement('div');
            notification.id = 'customNotification';
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                padding: 16px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                transform: translateX(400px);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                max-width: 350px;
                min-width: 280px;
            `;

            const bgColor = type === 'success' ?
                'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;' :
                'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;';

            notification.style.cssText += bgColor;

            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="flex-shrink: 0;">
                        <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 20 20">
                            ${type === 'success'
                                ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>'
                                : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>'
                            }
                        </svg>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 14px; margin-bottom: 2px;">
                            ${type === 'success' ? 'Succès' : 'Erreur'}
                        </div>
                        <div style="font-size: 13px; opacity: 0.95;">
                            ${message}
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" style="
                        background: none;
                        border: none;
                        color: currentColor;
                        cursor: pointer;
                        padding: 4px;
                        border-radius: 4px;
                        opacity: 0.7;
                        transition: opacity 0.2s;
                        flex-shrink: 0;
                    " onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">
                        <svg style="width: 16px; height: 16px; fill: currentColor;" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Animation d'entrée avec un léger délai
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 50);

            // Auto-suppression après 4 secondes avec animation de sortie
            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 400);
            }, 4000);
        }

        // Event listeners
        window.addEventListener('online', updateConnectionStatus);
        window.addEventListener('offline', updateConnectionStatus);
        syncButton.addEventListener('click', performSync);

        // Initial status check
        updateConnectionStatus();
    </script>
</body>

</html>
