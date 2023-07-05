@props([
    'tabs' => [],
])

<div 
    x-data="{ 
        tabs: @js($tabs),
        movingTab: '',
        padding: 0,
        activeTab: 0,
    }"
>
    <nav>
        <ul 
            class="relative flex list-none flex-wrap rounded-lg bg-blue-gray-50/60 p-1"
        >
            <template x-for="(item, index) in tabs" :key="item.category">
                <li
                    x-init="
                        $nextTick(() => {
                            width = Math.round($el.getBoundingClientRect().width),
                            padding == 0 ? padding = Math.round($el.getBoundingClientRect().x) : padding = padding,
                            distance = Math.round($el.getBoundingClientRect().left) - padding,
                            item.isActive ? (movingTab = `transform: translate3d(${distance}px, 0px, 0px); width: ${width}px`, activeTab = index) : (movingTab = movingTab, activeTab = activeTab)
                        })
                    "
                    class="z-30 flex-auto text-center" 
                    :class="item.isActive && 'pointer-events-none'"
                    
                    @click="
                        tabs = tabs.map(f => ({ ...f, isActive: f.category !== item.category ? false : !item.isActive})), 
                        activeTab = index,
                        distance = Math.round($el.getBoundingClientRect().left) - padding,
                        width = Math.round($el.getBoundingClientRect().width),
                        movingTab = `transform: translate3d(${distance}px, 0px, 0px); width: ${width}px`
                    "

                    @resize.window="activeTab == index ? (distance = Math.round($el.getBoundingClientRect().left) - padding, movingTab = `transform: translate3d(${distance}px, 0px, 0px); width: ${Math.round($el.getBoundingClientRect().width)}px`) : movingTab = movingTab"
                >
                    <a class="text-slate-700 z-30 mb-0 flex w-full cursor-pointer items-center justify-center rounded-lg border-0 bg-inherit px-0 py-1 transition-all ease-in-out" :class="item.isActive && 'active'" :aria-selected="item.isActive" :aria-controls="item.category">
                        <i class="mr-2 text-sm material-icons" x-text="item.icon" x-show="item.iconType == 'material'"></i>
                        <i class="mr-2 text-sm" :class="item.icon" x-show="item.iconType == 'fontawesome'"></i>
                        <span x-html="item.category"></span>
                    </a>
                </li>

            </template>

            <div
                class="z-10 absolute text-slate-700 rounded-lg bg-inherit flex-auto text-center bg-none border-0 block shadow"
                style="transition: all 0.5s ease 0s;"
                :style="movingTab"
            >
                <a class="z-30 mb-0 flex w-full cursor-pointer items-center justify-center rounded-lg border-0 px-0 py-1 transition-all ease-in-out bg-white text-white" aria-selected="true" style="animation: 0.2s ease 0s 1 normal none running none;">-</a>
            </div>
        </ul>
    </nav>

    <div class="p-5">
        <template x-for="item in tabs" :key="item.category">
            <div class="tab-panel" :class="item.isActive && 'active'" :id="item.category" x-show="item.isActive">
                <p class="block antialiased font-sans text-base leading-relaxed mb-4 font-normal text-blue-gray-500" x-html="item.content"></p>
            </div>
        </template>
    </div>

</div>