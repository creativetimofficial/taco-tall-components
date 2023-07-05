@props([
    'items' => [],
])


<div
    x-data="{
        accordion: @js($items),
    }"
>
    <template x-for="item in accordion" :key="item.title">

        <div class="relative mb-3">
            <h6 class="mb-0">
                <div 
                    class="normal-case border-slate-100 text-slate-700 rounded-t-1 relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500 transition-all ease-in"
                    :aria-expanded="item.isOpen"
                    @click="accordion = accordion.map(f => ({ ...f, isOpen: f.title !== item.title ? false : !f.isOpen}))"
                >
                    <span x-html="item.title"></span>
                    <i class="fa fa-plus absolute right-0 pt-1 text-xs" x-show="!item.isOpen"></i>
                    <i class="fa fa-minus absolute right-0 pt-1 text-xs" x-show="item.isOpen"></i>
                </div>
            </h6>
            <div
                x-init="if (item.isOpen) {
                    item.isOpen = false;
                    item.isOpen = true
                }"
                class="overflow-hidden transition-all duration-300 ease-in-out"
                :style="item.isOpen ? `max-height: ${$el.scrollHeight}px` : `max-height: 0px`"
            >
                <div class="p-4 text-sm leading-normal text-blue-gray-500/80" x-html="item.text"></div>

            </div>
        </div>

    </template>
</div>