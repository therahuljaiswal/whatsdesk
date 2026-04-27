@extends('layouts.app', ['title' => __('embeddedlogin::general.setup_title')])
@section('content')
<div class="header pb-8 pt-2 pt-md-7">
    <div class="container-fluid">
        <div class="header-body">
            <h1 class="mb-3 mt--3">💬 {{ __('embeddedlogin::general.setup_title') }}</h1>
            <div class="row align-items-center pt-2">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--8">
    <div class="row">
        <div class="col-12">
            @include('partials.flash')
        </div>

        {{-- Main Content --}}
        <div class="col-lg-8 col-md-7">

            @if(config('embeddedlogin.app_id', '') == '' || config('embeddedlogin.config_id', '') == '')
                {{-- Not Configured Warning --}}
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <div style="font-size: 48px; margin-bottom: 16px;">⚠️</div>
                        <h3>{{ __('Embedded Signup Not Configured') }}</h3>
                        <p class="text-muted mb-0">{{ __('embeddedlogin::general.not_configured') }}</p>
                    </div>
                </div>
            @else
                {{-- How It Works --}}
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">🚀 {{ __('embeddedlogin::general.setup_subtitle') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #25D366, #128C7E); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 20px; font-weight: bold;">1</div>
                                <h5>{{ __('embeddedlogin::general.step1_title') }}</h5>
                                <p class="text-muted small mb-0">{{ __('embeddedlogin::general.step1_desc') }}</p>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #1877F2, #0a5dc2); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 20px; font-weight: bold;">2</div>
                                <h5>{{ __('embeddedlogin::general.step2_title') }}</h5>
                                <p class="text-muted small mb-0">{{ __('embeddedlogin::general.step2_desc') }}</p>
                            </div>
                            <div class="col-md-4">
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #00C853, #009624); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 20px; font-weight: bold;">3</div>
                                <h5>{{ __('embeddedlogin::general.step3_title') }}</h5>
                                <p class="text-muted small mb-0">{{ __('embeddedlogin::general.step3_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Connect Button Card --}}
                <div class="card shadow mb-4" id="connect-card">
                    <div class="card-body text-center py-5">
                        @if(!$setupDone)
                            {{-- Not connected state --}}
                            <div id="connect-initial">
                                <div style="font-size: 56px; margin-bottom: 16px;">
                                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                        <circle cx="28" cy="28" r="28" fill="#25D366"/>
                                        <path d="M38.8 17.2C36.9 15.3 34.6 13.8 32.1 12.9C29.5 12 26.8 11.7 24.1 12.1C21.4 12.4 18.9 13.4 16.7 14.9C14.5 16.4 12.8 18.4 11.6 20.8C10.4 23.1 9.8 25.7 9.9 28.4C10 31.1 10.8 33.6 12.1 35.9L10 46L20.3 43.9C22.4 45.1 24.7 45.8 27.1 45.9C29.5 46 31.9 45.5 34 44.5C36.2 43.5 38 42 39.4 40.1C40.9 38.2 41.9 36 42.3 33.6C42.7 31.2 42.5 28.7 41.8 26.4C41 24.1 39.7 22 38 20.3L38.8 17.2ZM35.5 33.7C35.1 34.5 33.9 35.2 33 35.4C32.4 35.5 31.6 35.6 28.5 34.3C24.8 32.8 22.4 29 22.2 28.7C22 28.4 20.5 26.5 20.5 24.5C20.5 22.5 21.5 21.6 21.9 21.1C22.3 20.6 22.7 20.5 23 20.5H23.8C24.1 20.5 24.4 20.4 24.8 21.3C25.1 22.2 25.9 24.2 26 24.4C26.1 24.6 26.1 24.8 26 25C25.9 25.2 25.8 25.4 25.6 25.6C25.4 25.8 25.2 26.1 25.1 26.2C24.9 26.4 24.7 26.6 24.9 27C25.1 27.4 25.9 28.6 27 29.6C28.5 30.9 29.7 31.3 30.1 31.5C30.5 31.7 30.7 31.7 30.9 31.4C31.1 31.1 31.9 30.2 32.1 29.8C32.3 29.4 32.6 29.4 32.9 29.5C33.2 29.6 35.2 30.6 35.6 30.8C36 31 36.2 31.1 36.3 31.3C36.4 31.7 36.4 32.5 35.5 33.7Z" fill="white"/>
                                    </svg>
                                </div>
                                <h3 class="mb-3">{{ __('Connect Your WhatsApp Business') }}</h3>
                                <p class="text-muted mb-4">{{ __('embeddedlogin::general.connect_description') }}</p>
                                <button 
                                    type="button" 
                                    id="btn-connect-whatsapp"
                                    onclick="launchWhatsAppSignup()"
                                    class="btn btn-lg text-white px-5 py-3"
                                    style="background: linear-gradient(135deg, #1877F2, #0a5dc2); border: none; border-radius: 12px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(24,119,242,0.4); transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(24,119,242,0.5)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(24,119,242,0.4)'"
                                >
                                    <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="white">
                                        <path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/>
                                    </svg>
                                    {{ __('embeddedlogin::general.connect_whatsapp') }}
                                </button>
                            </div>

                            {{-- Connecting state (hidden by default) --}}
                            <div id="connect-loading" style="display: none;">
                                <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <h3 class="mb-2">{{ __('embeddedlogin::general.connecting') }}</h3>
                                <p class="text-muted mb-0">{{ __('Setting up your WhatsApp Business Account...') }}</p>
                            </div>

                            {{-- Error state (hidden by default) --}}
                            <div id="connect-error" style="display: none;">
                                <div style="font-size: 48px; margin-bottom: 16px;">❌</div>
                                <h3 class="mb-2 text-danger">{{ __('embeddedlogin::general.connection_failed') }}</h3>
                                <p class="text-muted mb-3" id="error-message"></p>
                                <button 
                                    type="button" 
                                    onclick="resetConnectUI()"
                                    class="btn btn-outline-primary"
                                >
                                    {{ __('Try Again') }}
                                </button>
                            </div>

                            {{-- Success state (hidden by default) --}}
                            <div id="connect-success" style="display: none;">
                                <div style="font-size: 48px; margin-bottom: 16px;">✅</div>
                                <h3 class="mb-2 text-success">{{ __('embeddedlogin::general.connected') }}</h3>
                                <p class="text-muted mb-3">{{ __('embeddedlogin::general.connected_description') }}</p>
                                <div id="success-details" class="text-left mx-auto" style="max-width: 400px;"></div>
                                <a href="{{ route('chat.index') }}" class="btn btn-success mt-3">
                                    🚀 {{ __('Start Using WhatsApp') }}
                                </a>
                            </div>
                        @else
                            {{-- Already connected --}}
                            <div style="font-size: 48px; margin-bottom: 16px;">✅</div>
                            <h3 class="mb-2 text-success">{{ __('embeddedlogin::general.connected') }}</h3>
                            <p class="text-muted mb-3">{{ __('embeddedlogin::general.connected_description') }}</p>
                            <div class="text-left mx-auto mb-4" style="max-width: 400px;">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ __('embeddedlogin::general.waba_id') }}</span>
                                    <strong>{{ $company->getConfig('whatsapp_business_account_id', '—') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ __('embeddedlogin::general.phone_number_id') }}</span>
                                    <strong>{{ $company->getConfig('whatsapp_phone_number_id', '—') }}</strong>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="gap: 12px;">
                                <a href="{{ route('chat.index') }}" class="btn btn-success">
                                    💬 {{ __('Go to Chat') }}
                                </a>
                                <button 
                                    type="button" 
                                    onclick="launchWhatsAppSignup()"
                                    class="btn btn-outline-primary"
                                >
                                    🔄 {{ __('embeddedlogin::general.reconnect') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Manual Setup Fallback --}}
                <div class="card shadow mb-4">
                    <div class="card-body text-center py-3">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('manual-setup-info').style.display = document.getElementById('manual-setup-info').style.display === 'none' ? 'block' : 'none';" class="text-muted">
                            ⚙️ {{ __('embeddedlogin::general.manual_setup') }}
                        </a>
                        <div id="manual-setup-info" style="display: none;" class="mt-3 text-left">
                            <div class="alert alert-light border">
                                <p class="mb-2"><strong>{{ __('If you prefer to set up manually:') }}</strong></p>
                                <ol class="mb-0 pl-3">
                                    <li>{{ __('Go to') }} <a target="_blank" href="https://developers.facebook.com/apps">{{ __('Facebook Developer Console') }}</a></li>
                                    <li>{{ __('Create a Facebook App with WhatsApp product') }}</li>
                                    <li>{{ __('Get your Permanent Access Token, Phone Number ID, and WABA ID') }}</li>
                                    <li>{{ __('Enter them in the company settings') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Status Sidebar --}}
        <div class="col-lg-4 col-md-5">
            <div class="card shadow">
                <div class="card-header shadow-lg">
                    <b>{{ __('WhatsApp Cloud API - Connection Status') }}</b>
                </div>
                <div class="card-body">
                    @if ($setupDone)
                        <div class="alert alert-success" role="alert">
                            <strong>{{ __('Success!') }}</strong> {{ __('You are now connected to WhatsApp Cloud API. You can start using the system.') }}
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <strong>{{ __('Not connected') }}</strong> {{ __('Click the Connect button to set up your WhatsApp Business Account.') }}
                        </div>
                    @endif

                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-2">
                            @if($setupDone)
                                <span class="badge badge-success mr-2">✓</span>
                            @else
                                <span class="badge badge-secondary mr-2">○</span>
                            @endif
                            <span>{{ __('Access Token') }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            @if($company->getConfig('whatsapp_phone_number_id', '') != '')
                                <span class="badge badge-success mr-2">✓</span>
                            @else
                                <span class="badge badge-secondary mr-2">○</span>
                            @endif
                            <span>{{ __('Phone Number ID') }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            @if($company->getConfig('whatsapp_business_account_id', '') != '')
                                <span class="badge badge-success mr-2">✓</span>
                            @else
                                <span class="badge badge-secondary mr-2">○</span>
                            @endif
                            <span>{{ __('Business Account ID') }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            @if($company->getConfig('whatsapp_webhook_verified', 'no') == 'yes')
                                <span class="badge badge-success mr-2">✓</span>
                            @else
                                <span class="badge badge-secondary mr-2">○</span>
                            @endif
                            <span>{{ __('Webhook Verified') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Facebook JavaScript SDK --}}
<script>
    // Load the Facebook JS SDK asynchronously
    window.fbAsyncInit = function () {
        FB.init({
            appId: '{{ config("embeddedlogin.app_id") }}',
            cookie: true,
            xfbml: true,
            version: 'v21.0'
        });
    };

    // Load the SDK
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Session logging: Listen for messages from the Embedded Signup popup
    // This captures WABA ID and phone number ID before the popup closes
    let sessionInfoData = {};
    window.addEventListener('message', function (event) {
        if (event.origin !== "https://www.facebook.com" && event.origin !== "https://web.facebook.com") {
            return;
        }

        try {
            if (typeof event.data === 'string') {
                let data = JSON.parse(event.data);
                if (data.type === 'WA_EMBEDDED_SIGNUP') {
                    // data.event can be: 'FINISH', 'CANCEL', 'ERROR'
                    if (data.data) {
                        sessionInfoData = data.data;
                        console.log('Embedded Signup session data:', sessionInfoData);
                        // sessionInfoData may contain:
                        // - phone_number_id
                        // - waba_id
                        // - current_step
                    }
                }
            }
        } catch (e) {
            // Not a JSON message, ignore
        }
    });

    /**
     * Launch the WhatsApp Embedded Signup flow
     */
    function launchWhatsAppSignup() {
        if (typeof FB === 'undefined') {
            alert('Facebook SDK is still loading. Please wait a moment and try again.');
            return;
        }

        FB.login(function (response) {
            if (response.authResponse) {
                const code = response.authResponse.code;
                console.log('Authorization code received');
                // Send the code to our backend
                sendCodeToBackend(code);
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            config_id: '{{ config("embeddedlogin.config_id") }}',
            response_type: 'code',
            override_default_response_type: true,
            extras: {
                feature: 'whatsapp_embedded_signup',
                version: 2,
                sessionInfoVersion: 2
            }
        });
    }

    /**
     * Send the authorization code to the backend for processing
     */
    function sendCodeToBackend(code) {
        // Show loading state
        showState('loading');

        fetch('{{ route("embeddedlogin.callback") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                code: code
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showState('success');
                // Show connection details
                let detailsHtml = '';
                if (data.data) {
                    detailsHtml += '<div class="d-flex justify-content-between py-2 border-bottom">';
                    detailsHtml += '<span class="text-muted">WABA ID</span>';
                    detailsHtml += '<strong>' + (data.data.waba_id || '—') + '</strong>';
                    detailsHtml += '</div>';
                    detailsHtml += '<div class="d-flex justify-content-between py-2 border-bottom">';
                    detailsHtml += '<span class="text-muted">Phone Number ID</span>';
                    detailsHtml += '<strong>' + (data.data.phone_number_id || '—') + '</strong>';
                    detailsHtml += '</div>';
                    if (data.data.phone_number) {
                        detailsHtml += '<div class="d-flex justify-content-between py-2 border-bottom">';
                        detailsHtml += '<span class="text-muted">Phone Number</span>';
                        detailsHtml += '<strong>' + data.data.phone_number + '</strong>';
                        detailsHtml += '</div>';
                    }
                }
                document.getElementById('success-details').innerHTML = detailsHtml;
            } else {
                showState('error');
                document.getElementById('error-message').textContent = data.message || 'An unknown error occurred.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showState('error');
            document.getElementById('error-message').textContent = 'Network error. Please check your connection and try again.';
        });
    }

    /**
     * Show a specific UI state
     */
    function showState(state) {
        document.getElementById('connect-initial').style.display = 'none';
        document.getElementById('connect-loading').style.display = 'none';
        document.getElementById('connect-error').style.display = 'none';
        document.getElementById('connect-success').style.display = 'none';

        if (state === 'initial') {
            document.getElementById('connect-initial').style.display = 'block';
        } else if (state === 'loading') {
            document.getElementById('connect-loading').style.display = 'block';
        } else if (state === 'error') {
            document.getElementById('connect-error').style.display = 'block';
        } else if (state === 'success') {
            document.getElementById('connect-success').style.display = 'block';
        }
    }

    /**
     * Reset to the initial connect UI
     */
    function resetConnectUI() {
        showState('initial');
    }
</script>
@endsection
