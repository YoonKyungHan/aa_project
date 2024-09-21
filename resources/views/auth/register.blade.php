<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4 items-center">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <div class="flex items-center">
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                        required autocomplete="phone" />
                    <x-button type="button" id="send_otp" class="ml-2 h-full">
                        {{ __('OTP') }}
                    </x-button>
                </div>
            </div>
            <div class="mt-4 items-center">
                <x-label for="confirmCode" value="{{ __('Confirm Code') }}" />
                <div class="flex items-center">
                    <x-input id="confirmCode" class="block mt-1 w-full" type="text" name="confirmCode" :value="old('confirmCode')"

                    required autocomplete="confirmCode" />
                <x-button type="button" id="confrimCodeButton" class="ml-2 h-full">
                    {{ __('OTP') }}
                </x-button>
                </div>
            </div>

            <div class="mt-4">

                <x-label for="phone_password" value="{{ __('Phone Password') }}" />
                <x-input id="phone_password" class="block mt-1 w-full" type="text" name="phone_password" required
                    autocomplete="phone_password" />
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div id="recaptcha-container"></div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    <div id="recaptcha-container"></div>

</x-guest-layout>
<script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-analytics.js";
    import {
        getAuth,
        signInWithPopup,
        GoogleAuthProvider,
        signInWithPhoneNumber,
        RecaptchaVerifier,
    } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-auth.js";

    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {

    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);

    const provider = new GoogleAuthProvider();
    const auth = getAuth();
    auth.languageCode = "ko";

    // document.getElementById("googleLogin").addEventListener("click", () => {
    //   signInWithPopup(auth, provider)
    //     .then((result) => {
    //       // This gives you a Google Access Token. You can use it to access the Google API.
    //       const credential = GoogleAuthProvider.credentialFromResult(result);
    //       const token = credential.accessToken;
    //       // The signed-in user info.
    //       const user = result.user;
    //       console.log(result);
    //       // ...
    //     })
    //     .catch((error) => {
    //       // Handle Errors here.
    //       const errorCode = error.code;
    //       const errorMessage = error.message;
    //       // The email of the user's account used.
    //       const email = error.customData.email;
    //       // The AuthCredential type that was used.
    //       const credential = GoogleAuthProvider.credentialFromError(error);
    //       console.log(error);
    //       // ...
    //     });
    // });
    window.recaptchaVerifier = new RecaptchaVerifier(
        "send_otp", {
            size: "invisible",
            callback: (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                onSignInSubmit();
            },
        },
        auth
    );

    document
        .getElementById("send_otp")
        .addEventListener("click", (event) => {
            event.preventDefault();

            const phoneNumber = document.getElementById("phone").value;
            const appVerifier = window.recaptchaVerifier;

            signInWithPhoneNumber(auth, "+82" + phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                    console.log(confirmationResult);
                    // ...
                })
                .catch((error) => {
                    console.log(error);
                    // Error; SMS not sent
                    // ...
                });
        });

    document
        .getElementById("confrimCodeButton")
        .addEventListener("click", (event) => {
            event.preventDefault();
            const code = document.getElementById("confirmCode").value;
            confirmationResult
                .confirm(code)
                .then((result) => {
                    // User signed in successfully.
                    const user = result.user;
                    console.log(result);
                    // ...
                })
                .catch((error) => {
                    console.log(error);
                    // User couldn't sign in (bad verification code?)
                    // ...
                });
        });
</script>
