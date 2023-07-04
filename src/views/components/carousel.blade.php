@props([
    'data' => [],
])
<div class="grid" x-data="{ activeSlide: 1, slides: @js($data)}">
    <div class="mx-auto relative">

        <!-- Slides -->
        <template x-for="slide in slides" :key="slide.id">
            <div x-show="activeSlide === slide.id" class="flex flex-col items-center w-[45rem]">
                <img :src="slide.src" class="object-cover w-full h-[450px] overflow-hidden rounded-lg " />
            </div>
        </template>

        <!-- Prev/Next Arrows -->
        <div class="absolute inset-0 flex">
            <div class="flex items-center justify-start w-1/2">
                <button
                    class="text-white/80 hover:text-white hover:bg-gray-300/20 rounded-lg p-2 text-4xl font-bold ml-6"
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                    &#8592;
                </button>
            </div>
            <div class="flex items-center justify-end w-1/2">
                <button
                    class="text-white/80 hover:text-white hover:bg-gray-300/20 rounded-lg p-2 text-4xl font-bold mr-6"
                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                    &#8594;
                </button>
            </div>
        </div>

        <!-- Buttons -->
        <div class="absolute w-full flex items-center justify-center px-4">
            <template x-for="slide in slides" :key="slide.id">
                <button
                    class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                    :class="{
                        'bg-[#e91e63]': activeSlide === slide.id,
                        'bg-gray-500/20': activeSlide !== slide.id
                    }" x-on:click="activeSlide = slide.id"></button>
            </template>
        </div>
    </div>
</div>