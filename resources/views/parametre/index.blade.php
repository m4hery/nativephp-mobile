@extends('layout.app')

@section('title', 'Paramètres')

@section('content')
    <style>
        /* ==========================
           LAYOUT GÉNÉRAL
        =========================== */
        .settings-page {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #fef2f2 0, #f9fafb 40%, #e5e7eb 100%);
            padding-bottom: 40px;
        }

        .settings-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 100px 16px 24px;
        }

        @media (min-width: 640px) {
            .settings-container {
                padding-top: 110px;
                padding-left: 24px;
                padding-right: 24px;
            }
        }

        @media (min-width: 1024px) {
            .settings-container {
                padding-top: 120px;
                padding-left: 32px;
                padding-right: 32px;
            }
        }

        .settings-stack {
            display: flex;
            flex-direction: column;
            row-gap: 16px;
        }

        @media (min-width: 640px) {
            .settings-stack {
                row-gap: 20px;
            }
        }

        /* ==========================
           TOPBAR FIXE
        =========================== */
        .settings-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 40;
            background: linear-gradient(90deg, #dc2626, #b91c1c);
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.35);
        }

        .settings-header-inner {
            display: flex;
            align-items: center;
            padding: 16px;
            padding-top: 20px;
        }

        @media (min-width: 640px) {
            .settings-header-inner {
                padding: 18px 20px 14px;
                padding-top: 24px;
            }
        }

        .settings-back-btn {
            margin-right: 8px;
            padding: 8px;
            border-radius: 999px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .settings-back-btn:hover {
            background-color: rgba(255, 255, 255, 0.18);
        }

        .settings-back-btn:active {
            transform: scale(0.95);
        }

        .settings-header-title {
            flex: 1;
            text-align: center;
            margin-right: 32px; /* pour que le texte ne passe pas sous le bouton retour */
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        @media (min-width: 640px) {
            .settings-header-title {
                font-size: 20px;
                margin-right: 40px;
            }
        }

        .settings-header-progress {
            height: 4px;
            background: linear-gradient(90deg, rgba(248, 113, 113, 0.3), rgba(251, 113, 133, 0.5));
        }

        /* ==========================
           ALERTES (SUCCESS / ERROR)
        =========================== */
        .settings-alert {
            border-radius: 16px;
            padding: 10px 14px;
            font-size: 13px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        }

        .settings-alert--success {
            background-color: #ecfdf3;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .settings-alert--error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        /* ==========================
           CARTE UTILISATEUR
        =========================== */
        .settings-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 640px) {
            .settings-card {
                border-radius: 22px;
                padding: 18px;
            }
        }

        @media (min-width: 768px) {
            .settings-card {
                border-radius: 24px;
                padding: 20px;
            }
        }

        .settings-card--gradient {
            background: linear-gradient(135deg, #ffffff, #f9fafb);
        }

        .settings-card-deco {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 110px;
            height: 110px;
            background: radial-gradient(circle, rgba(254, 202, 202, 0.9), transparent 70%);
            opacity: 0.6;
        }

        .user-profile {
            display: flex;
            flex-direction: row;
            align-items: center;
            column-gap: 12px;
            position: relative;
            z-index: 1;
        }

        .user-avatar-wrapper {
            flex-shrink: 0;
            display: flex;
            justify-content: center;
        }

        .user-avatar {
            width: 64px;
            height: 64px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 20px;
            box-shadow: 0 8px 18px rgba(239, 68, 68, 0.45);
        }

        @media (min-width: 640px) {
            .user-avatar {
                width: 76px;
                height: 76px;
                font-size: 22px;
            }
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            margin: 0 0 2px 0;
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (min-width: 640px) {
            .user-name {
                font-size: 18px;
            }
        }

        @media (min-width: 768px) {
            .user-name {
                font-size: 20px;
            }
        }

        .user-email {
            margin: 0;
            font-size: 12px;
            color: #6b7280;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (min-width: 640px) {
            .user-email {
                font-size: 13px;
            }
        }

        /* ==========================
           SYNCHRONISATION
        =========================== */
        .settings-card-title-row {
            display: flex;
            align-items: center;
            margin-bottom: 14px;
        }

        .settings-card-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background-color: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        @media (min-width: 640px) {
            .settings-card-icon-circle {
                width: 40px;
                height: 40px;
                margin-right: 12px;
            }
        }

        .settings-card-title {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #111827;
        }

        @media (min-width: 640px) {
            .settings-card-title {
                font-size: 17px;
            }
        }

        .sync-button {
            width: 100%;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            margin-top: 4px;
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.45);
            transition: transform 0.1s ease, box-shadow 0.1s ease, opacity 0.2s ease;
        }

        @media (min-width: 640px) {
            .sync-button {
                font-size: 15px;
                padding: 14px 18px;
            }
        }

        .sync-button:hover:not(:disabled) {
            box-shadow: 0 10px 22px rgba(30, 64, 175, 0.6);
        }

        .sync-button:active:not(:disabled) {
            transform: scale(0.97);
        }

        .sync-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        .sync-button-icon {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }

        @media (min-width: 640px) {
            .sync-button-icon {
                width: 22px;
                height: 22px;
                margin-right: 10px;
            }
        }

        .sync-button-text {
            font-size: 14px;
        }

        @media (min-width: 640px) {
            .sync-button-text {
                font-size: 15px;
            }
        }

        /* ==========================
           STATISTIQUES SYNCHRO
        =========================== */
        .settings-stats-block {
            margin-top: 16px;
        }

        .settings-stats-title {
            margin: 0 0 10px 0;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .settings-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        @media (min-width: 1024px) {
            .settings-stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .stats-card {
            border-radius: 12px;
            padding: 10px;
            border: 1px solid;
        }

        .stats-card-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stats-card-left {
            display: flex;
            align-items: center;
        }

        .stats-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .stats-card-label {
            font-size: 11px;
            font-weight: 500;
        }

        .stats-card-value {
            font-size: 18px;
            font-weight: 700;
        }

        /* variantes couleurs */
        .stats-card--blue {
            background: linear-gradient(90deg, #eff6ff, #dbeafe);
            border-color: #bfdbfe;
        }

        .stats-card--blue .stats-card-icon {
            background-color: #3b82f6;
        }

        .stats-card--blue .stats-card-label {
            color: #1d4ed8;
        }

        .stats-card--blue .stats-card-value {
            color: #1e40af;
        }

        .stats-card--green {
            background: linear-gradient(90deg, #ecfdf3, #bbf7d0);
            border-color: #bbf7d0;
        }

        .stats-card--green .stats-card-icon {
            background-color: #22c55e;
        }

        .stats-card--green .stats-card-label {
            color: #15803d;
        }

        .stats-card--green .stats-card-value {
            color: #166534;
        }

        .stats-card--purple {
            background: linear-gradient(90deg, #f5f3ff, #ede9fe);
            border-color: #ddd6fe;
        }

        .stats-card--purple .stats-card-icon {
            background-color: #8b5cf6;
        }

        .stats-card--purple .stats-card-label {
            color: #5b21b6;
        }

        .stats-card--purple .stats-card-value {
            color: #4c1d95;
        }

        .stats-card--orange {
            background: linear-gradient(90deg, #fff7ed, #fed7aa);
            border-color: #fed7aa;
        }

        .stats-card--orange .stats-card-icon {
            background-color: #f97316;
        }

        .stats-card--orange .stats-card-label {
            color: #9a3412;
        }

        .stats-card--orange .stats-card-value {
            color: #c2410c;
        }

        .stats-card--indigo {
            background: linear-gradient(90deg, #eef2ff, #e0e7ff);
            border-color: #c7d2fe;
        }

        .stats-card--indigo .stats-card-icon {
            background-color: #6366f1;
        }

        .stats-card--indigo .stats-card-label {
            color: #3730a3;
        }

        .stats-card--indigo .stats-card-value {
            color: #312e81;
        }

        .stats-card--pink {
            background: linear-gradient(90deg, #fdf2f8, #fce7f3);
            border-color: #f9a8d4;
        }

        .stats-card--pink .stats-card-icon {
            background-color: #ec4899;
        }

        .stats-card--pink .stats-card-label {
            color: #9d174d;
        }

        .stats-card--pink .stats-card-value {
            color: #9d174d;
        }

        .stats-card--teal {
            background: linear-gradient(90deg, #ecfeff, #ccfbf1);
            border-color: #99f6e4;
        }

        .stats-card--teal .stats-card-icon {
            background-color: #14b8a6;
        }

        .stats-card--teal .stats-card-label {
            color: #0f766e;
        }

        .stats-card--teal .stats-card-value {
            color: #0f766e;
        }

        .stats-card--red {
            background: linear-gradient(90deg, #fef2f2, #fee2e2);
            border-color: #fecaca;
        }

        .stats-card--red .stats-card-icon {
            background-color: #ef4444;
        }

        .stats-card--red .stats-card-label {
            color: #b91c1c;
        }

        .stats-card--red .stats-card-value {
            color: #b91c1c;
        }

        /* ==========================
           STATUT SYSTÈME
        =========================== */
        .status-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .connection-status {
            border-radius: 14px;
            padding: 12px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .connection-status--online {
            background-color: #ecfdf3;
        }

        .connection-status--offline {
            background-color: #fef2f2;
        }

        .connection-icon {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            margin: 0 auto 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .connection-icon--online {
            background-color: #22c55e;
        }

        .connection-icon--offline {
            background-color: #ef4444;
        }

        .connection-label {
            font-size: 12px;
            font-weight: 600;
        }

        .connection-label--online {
            color: #15803d;
        }

        .connection-label--offline {
            color: #b91c1c;
        }

        .connection-text {
            font-size: 12px;
        }

        .connection-text--online {
            color: #16a34a;
        }

        .connection-text--offline {
            color: #dc2626;
        }

        /* ==========================
           ACTIONS RAPIDES
        =========================== */
        .quick-actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .logout-button {
            border-radius: 14px;
            padding: 12px 16px;
            border: none;
            background: linear-gradient(90deg, #ef4444, #b91c1c);
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(185, 28, 28, 0.55);
            text-decoration: none;
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }

        @media (min-width: 640px) {
            .logout-button {
                padding: 14px 18px;
                font-size: 14px;
            }
        }

        .logout-button:hover {
            box-shadow: 0 10px 24px rgba(127, 29, 29, 0.7);
        }

        .logout-button:active {
            transform: scale(0.97);
        }

        .logout-icon {
            width: 20px;
            height: 20px;
            margin-bottom: 4px;
        }

        .logout-text {
            font-size: 12px;
            text-align: center;
        }

        @media (min-width: 640px) {
            .logout-text {
                font-size: 13px;
            }
        }

        /* ==========================
           LOADER FULLSCREEN
        =========================== */
        .loader-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
        }

        .loader-modal {
            background-color: #ffffff;
            border-radius: 18px;
            padding: 24px 20px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.4);
            max-width: 320px;
            width: 100%;
            text-align: center;
        }

        .loader-spinner {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            border-radius: 999px;
            border: 4px solid #fecaca;
            border-top-color: #dc2626;
            animation: spin 0.9s linear infinite;
        }

        .loader-title {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }

        .loader-text {
            margin: 0;
            font-size: 13px;
            color: #6b7280;
        }

        .loader-dots {
            margin-top: 14px;
            display: flex;
            justify-content: center;
            column-gap: 4px;
        }

        .loader-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background-color: #dc2626;
            animation: bounce 0.7s infinite alternate;
        }

        .loader-dot:nth-child(2) {
            animation-delay: 0.15s;
        }

        .loader-dot:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce {
            to {
                transform: translateY(-4px);
                opacity: 0.6;
            }
        }

        /* ==========================
           NOTIFICATIONS TOAST
        =========================== */
        .notification {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
            padding: 10px 18px;
            border-radius: 999px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.35);
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            opacity: 1;
            transition: opacity 0.3s ease, transform 0.3s ease;
            white-space: nowrap;
        }

        .notification--hidden {
            opacity: 0;
            transform: translate(-50%, -10px);
        }

        .notification--success {
            background-color: #16a34a;
        }

        .notification--error {
            background-color: #dc2626;
        }

        .notification--warning {
            background-color: #ea580c;
        }

        .notification--info {
            background-color: #2563eb;
        }
    </style>

    {{-- HEADER FIXE --}}
    <div class="settings-header">
        <div class="settings-header-inner">
            <a href="{{ route('menu') }}" class="settings-back-btn">
                <svg class="settings-back-icon" width="24" height="24" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="settings-header-title">Paramètres</h1>
        </div>
        <div class="settings-header-progress"></div>
    </div>

    {{-- CONTENU --}}
    <div class="settings-page">
        <div class="settings-container">
            <div class="settings-stack">

                {{-- Messages de succès / erreur --}}
                @if (session('success'))
                    <div class="settings-alert settings-alert--success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="settings-alert settings-alert--error">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Profil utilisateur --}}
                <div class="settings-card settings-card--gradient">
                    <div class="settings-card-deco"></div>
                    <div class="user-profile">
                        <div class="user-avatar-wrapper">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->firstname ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                        <div class="user-info">
                            <p class="user-name">
                                {{ Auth::user()->firstname ?? 'Utilisateur' }}
                            </p>
                            <p class="user-email">
                                {{ Auth::user()->email ?? 'Email non défini' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Synchronisation --}}
                <div class="settings-card">
                    <div class="settings-card-title-row">
                        <div class="settings-card-icon-circle">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <h3 class="settings-card-title">Synchronisation</h3>
                    </div>

                    <form method="POST" action="{{ route('parametre.syncAll') }}" onsubmit="return handleSyncSubmit(event)">
                        @csrf
                        <button type="submit" id="syncBtn" class="sync-button">
                            <svg class="sync-button-icon" id="syncIcon" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span id="syncText" class="sync-button-text">Synchroniser maintenant</span>
                        </button>
                    </form>

                    {{-- Stats synchro --}}
                    <div class="settings-stats-block">
                        <h4 class="settings-stats-title">Données synchronisées :</h4>

                        <div class="settings-stats-grid">
                            {{-- Demandes d'aide --}}
                            <div class="stats-card stats-card--blue">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Demandes</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalAidRequests }}</span>
                                </div>
                            </div>

                            {{-- Bénéficiaires --}}
                            <div class="stats-card stats-card--green">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Bénéficiaires</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalBeneficiaries }}</span>
                                </div>
                            </div>

                            {{-- Distributions --}}
                            <div class="stats-card stats-card--purple">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Distributions</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalDistributions }}</span>
                                </div>
                            </div>

                            {{-- Sessions de distribution --}}
                            <div class="stats-card stats-card--orange">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Sessions</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalDistributionSessions }}</span>
                                </div>
                            </div>

                            {{-- Orientations --}}
                            <div class="stats-card stats-card--indigo">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Orientations</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalOrientations }}</span>
                                </div>
                            </div>

                            {{-- Dossiers --}}
                            <div class="stats-card stats-card--pink">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Dossiers</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalFolders }}</span>
                                </div>
                            </div>

                            {{-- Villages --}}
                            <div class="stats-card stats-card--teal">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Villages</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalVillages }}</span>
                                </div>
                            </div>

                            {{-- Prescripteurs --}}
                            <div class="stats-card stats-card--orange">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Prescripteurs</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalPrescribers }}</span>
                                </div>
                            </div>

                            {{-- Structures --}}
                            <div class="stats-card stats-card--red">
                                <div class="stats-card-inner">
                                    <div class="stats-card-left">
                                        <div class="stats-card-icon">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="stats-card-label">Structures</span>
                                    </div>
                                    <span class="stats-card-value">{{ $totalStructures }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statut système --}}
                <div class="settings-card">
                    <div class="settings-card-title-row">
                        <div class="settings-card-icon-circle" style="background-color:#dcfce7;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="settings-card-title">Statut système</h3>
                    </div>

                    <div class="status-grid">
                        <div class="connection-status" id="connectionStatus">
                            <div class="connection-icon" id="connectionIcon">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"
                                     id="connectionSvg">
                                    <path fill-rule="evenodd"
                                          d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="connection-label" id="connectionLabel">Connexion</div>
                            <div class="connection-text" id="connectionText">Vérification...</div>
                        </div>
                    </div>
                </div>

                {{-- Actions rapides --}}
                <div class="quick-actions">
                    <a href="{{ route('login.logout') }}" class="logout-button">
                        <svg class="logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="logout-text">Déconnexion</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let isOnline = navigator.onLine;
        let connectionCheckInterval;

        // Loader plein écran
        function showLoader() {
            if (document.getElementById('fullScreenLoader')) return;

            const wrapper = document.createElement('div');
            wrapper.id = 'fullScreenLoader';
            wrapper.innerHTML = `
                <div class="loader-overlay">
                    <div class="loader-modal">
                        <div class="loader-spinner"></div>
                        <h3 class="loader-title">Synchronisation</h3>
                        <p class="loader-text">Veuillez patienter...</p>
                        <div class="loader-dots">
                            <span class="loader-dot"></span>
                            <span class="loader-dot"></span>
                            <span class="loader-dot"></span>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(wrapper);
        }

        // Gestion du submit de sync
        function handleSyncSubmit(event) {
            if (!isOnline) {
                event.preventDefault();
                showNotification('Aucune connexion internet disponible', 'error');
                return false;
            }
            showLoader();
            return true;
        }

        // Notifications toast
        function showNotification(message, type = 'info') {
            const previous = document.querySelectorAll('.notification');
            previous.forEach(n => n.remove());

            const notif = document.createElement('div');
            notif.className = 'notification notification--hidden';

            if (type === 'success') {
                notif.classList.add('notification--success');
            } else if (type === 'error') {
                notif.classList.add('notification--error');
            } else if (type === 'warning') {
                notif.classList.add('notification--warning');
            } else {
                notif.classList.add('notification--info');
            }

            notif.textContent = message;
            document.body.appendChild(notif);

            // apparition
            requestAnimationFrame(() => {
                notif.classList.remove('notification--hidden');
            });

            // disparition
            setTimeout(() => {
                notif.classList.add('notification--hidden');
                setTimeout(() => notif.remove(), 300);
            }, 4000);
        }

        // Vérification connexion
        async function checkInternetConnection() {
            try {
                await fetch('https://www.google.com/favicon.ico', {
                    method: 'HEAD',
                    mode: 'no-cors',
                    cache: 'no-cache'
                });
                return true;
            } catch (error) {
                return false;
            }
        }

        function updateConnectionStatus(online) {
            const statusDiv = document.getElementById('connectionStatus');
            const iconDiv = document.getElementById('connectionIcon');
            const labelDiv = document.getElementById('connectionLabel');
            const textDiv = document.getElementById('connectionText');
            const syncBtn = document.getElementById('syncBtn');
            const svg = document.getElementById('connectionSvg');

            statusDiv.className = 'connection-status ' + (online ? 'connection-status--online' : 'connection-status--offline');
            iconDiv.className = 'connection-icon ' + (online ? 'connection-icon--online' : 'connection-icon--offline');
            labelDiv.className = 'connection-label ' + (online ? 'connection-label--online' : 'connection-label--offline');
            textDiv.className = 'connection-text ' + (online ? 'connection-text--online' : 'connection-text--offline');

            if (online) {
                textDiv.textContent = 'En ligne';
                svg.innerHTML = `
                    <path d="M2.05 7.05a9 9 0 0112.73 0L15.55 7.64 14.14 9.05a7 7 0 00-9.9 0L2.05 7.05Zm-2 2l1.41-1.41a11 11 0 0115.56 0L20.55 9.05 19.14 10.46a9 9 0 00-12.73 0L0.05 9.05ZM8 15a2 2 0 114 0 2 2 0 01-4 0Z"></path>
                `;
                syncBtn.disabled = false;
            } else {
                textDiv.textContent = 'Hors ligne';
                svg.innerHTML = `
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414 5.707 15.707a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                `;
                syncBtn.disabled = true;
            }
        }

        async function performConnectionCheck() {
            const online = await checkInternetConnection();
            isOnline = online;
            updateConnectionStatus(online);
        }

        window.addEventListener('online', () => {
            setTimeout(performConnectionCheck, 800);
        });

        window.addEventListener('offline', () => {
            isOnline = false;
            updateConnectionStatus(false);
        });

        document.addEventListener('DOMContentLoaded', function () {
            performConnectionCheck();
            connectionCheckInterval = setInterval(performConnectionCheck, 30000);
        });

        window.addEventListener('beforeunload', () => {
            if (connectionCheckInterval) {
                clearInterval(connectionCheckInterval);
            }
        });
    </script>
@endsection
