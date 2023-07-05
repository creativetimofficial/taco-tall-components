@props([
    'content' => '',
    'title' => '',
    'placement' => 'bottom-right',
    'timeout' => 3000,
])

<div x-data @click="$dispatch('notify', { message: '{{ $content }}', title: '{{ $title }}' })" class="w-fit">
    {{ $slot }}
</div>

<div x-data="{
        messages: [],
        timeout: {{ $timeout }}, // 3000 = 3 seconds
        remove(message) {
            this.messages.splice(this.messages.indexOf(message), 1)
        },
    }"
    @class([
        'fixed z-50 p-4',
        'bottom-0 right-0' => $placement === 'bottom-right',
        'bottom-0 left-0' => $placement === 'bottom-left',
        'top-0 right-0' => $placement === 'top-right',
        'top-0 left-0' => $placement === 'top-left',
    ])
    @notify.window="let message = $event.detail; messages.push(message); setTimeout(() => { remove(message) }, timeout)"

>
    <template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden>
        <div class="p-3 w-[350px] text-sm rounded-md mb-4 shadow-md transition-opacity bg-white">
            <div class="flex items-center p-3 bg-clip-padding text-light-blue-900 place-content-between">
                <p x-html="message.title"></p>
                <button @click="remove(message)"
                    class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-3 break-words">
                <p x-html="message.message"></p>
            </div>
        </div>
    </template>
</div>