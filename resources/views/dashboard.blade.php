<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                {{-- آمار کالکشن‌ها --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ \App\Models\Collection::count() }}</h3>
                                <p class="text-gray-600">کالکشن</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- آمار گالری --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ \App\Models\Gallery::count() }}</h3>
                                <p class="text-gray-600">تصویر گالری</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- آمار پیام‌ها --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ \App\Models\ContactMessage::where('status', 'new')->count() }}</h3>
                                <p class="text-gray-600">پیام جدید</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- پیام‌های اخیر --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">آخرین پیام‌ها</h3>
                    @php
                        $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get();
                    @endphp
                    
                    @if($recentMessages->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentMessages as $msg)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            @if($msg->status === 'new')
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                            @endif
                                            <h4 class="font-medium text-gray-900">{{ $msg->name }}</h4>
                                            {!! $msg->status_badge !!}
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($msg->subject, 50) }}</p>
                                        <p class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</p>
                                    </div>
                                    <a href="{{ route('admin.contact-messages.show', $msg->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                مشاهده همه پیام‌ها →
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">هیچ پیامی دریافت نشده است</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>