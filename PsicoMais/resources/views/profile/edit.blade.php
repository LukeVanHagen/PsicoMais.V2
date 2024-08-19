<x-app-layout>

    <style>
        /* General Styles */
        .py-12 {
            padding-top: 48px;
            padding-bottom: 48px;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Card Styles */
        .card {

            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            max-width: 600px;
            width: 100%;
        }

        .max-w-xl {
            max-width: 100%;
            margin: 0 auto;
        }

        /* Section Title Styles */
        .section-title {
            font-size: 28px;
            font-weight: bold;
            color: #000000;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
        }
    </style>

    <h3 class="section-title">
        Perfil
    </h3>

    <div class="py-12">
        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
