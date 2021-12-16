<x-app-layout>

    <x-slot name="title">
        Analytics
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                {{ __('Analytics') }}
            </div>
            </a>
        </div>
    </x-slot>

    <div class="flex-col">
        <div>
            <span class="font-bold text-lg">
                Total Requests:
            </span>
            {{ $analytics['totalRequests'] }}
        </div>
        <div>
            <span class="font-bold text-lg">
                Average Response Time (in seconds):
            </span>
            {{ $analytics['averageResponseTime'] }}
        </div>
        <div class="mt-6">
            <div class="font-bold text-xl">
                Route Statistics:
            </div>
            <div class="mt-2 font-semibold text-lg">
                Amount of Visits:
            </div>
            @foreach ($analytics['routesByVisits'] as $route => $visits) 
            <div>
                {{ preg_split('/(?=(?<![A-Z]|^)[A-Z])/', $route)[1] }} {{ preg_split('/(?=(?<![A-Z]|^)[A-Z])/', $route)[0] }} {{ $visits }}
            </div>
            @endforeach
            
            <div class="font-semibold text-lg">
                Worst response time (in seconds):
            </div>
            @foreach ($analytics['routesByTime'] as $route => $visits) 
            <div>
                {{ preg_split('/(?=(?<![A-Z]|^)[A-Z])/', $route)[1] }} {{ preg_split('/(?=(?<![A-Z]|^)[A-Z])/', $route)[0] }} {{ $visits }}
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
