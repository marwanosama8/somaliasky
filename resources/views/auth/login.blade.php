@extends('layouts.app')
@section('styles')
    <style>
        .search,
        nav {
            display: none !important;
        }
    </style>
@endsection
@section('content')


    <center>
        <div class="tw-m-auto">
            <h3 class="tw-py-10 tw-font-bold tw-text-xl">إنشاء حساب / تسجيل دخول</h3>
            <form method="post" action="{{ route('login-form') }}">
                @csrf
                 <div id="app" class="tw-flex tw-w-2/3 md:tw-w-1/3" dir="ltr">
                    <country-selection :countries='{{App\Models\Country::whereIn('id', [69,102,207])->get()}}'></country-selection>
                    <label for="states" class="tw-sr-only">Choose a state</label>
                    <input type="text"
                        class="tw-bg-gray-50 tw-text-center tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-r-lg tw-border-l-gray-100 dark:tw-border-l-gray-700 tw-border-l-2 focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500"
                        name="phone" placeholder="{{ __('lang.phone') }}" id="">
                </div>
                <button type="submit"
                    class="tw-my-10 tw-py-3 tw-px-6 tw-bg-primary tw-font-bold tw-text-white tw-rounded-md tw-w-1/2 md:tw-w-1/3">
                    تسجيل الدخول
                </button>
            </form>


            <h3 class=" md:tw-w-[28%] tw-font-bold">
                باستخدامك السوق الدباسي أنت توافق على اتفاقية الاستخدام وسياسة المحتوى شاهد المزيد على
            </h3>
        </div>
    </center>
@section('scripts')
    <script src="{{ asset('/new/assets/js/flowbite.js') }}"></script>
                <script src="{{ asset('/dist/js/app.js') }}"></script>

@endsection
@endsection
