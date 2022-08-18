@extends('layouts.main')
@section('container')
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Settings</h3>
                    <p class="mt-1 text-sm text-gray-600">Manage your notifications and password account.</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <fieldset>
                                <legend class="contents text-base font-medium text-gray-900">Push Notifications</legend>
                                <p class="text-sm text-gray-500">Get notifications from anyone doing activities.</p>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-center">
                                        <input id="push-everything" name="push-notifications" type="radio"
                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                                            Everything </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="push-nothing" name="push-notifications" type="radio"
                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700"> No
                                            push notifications </label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="sr-only">By Email</legend>
                                <div class="text-base font-medium text-gray-900" aria-hidden="true">By Email</div>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="comments" name="comments" type="checkbox"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="comments" class="font-medium text-gray-700">Saved Post</label>
                                            <p class="text-gray-500">Get notified when someones saved my post.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="candidates" name="candidates" type="checkbox"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="candidates" class="font-medium text-gray-700">New Post</label>
                                            <p class="text-gray-500">Get notified when someones post something new.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="contents text-base font-medium text-gray-900">Change Password</legend>
                                <p class="text-sm text-gray-500">Use secure password for more secure account.</p>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-center">
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span
                                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                Password</span>
                                            <input type="text" name="linkedin_account" id="linkedin_account"
                                                value=""
                                                class="@error('linkedin_account') is-invalid @enderror focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-60 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                placeholder=" ******************************** ">
                                            @error('linkedin_account')
                                                <div class="invalid-feedback ms-4">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="px-4 py-6 bg-gray-100 text-center sm:px-6">
                <form action="{{ url('profile/' . $profile->username) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Are you sure delete this account?')"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">Delete
                        Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
