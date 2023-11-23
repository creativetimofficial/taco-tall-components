@props([
    'id' => uniqid('input_'),
    'options',
    'selected',
    'dateFormat' => 'DD-MM-YYYY',
    'dropMaterial' => false,
    'label' => '',
    'inputType' => 'static',
    'multiple' => false,
    'color' => null,
    'textColor' => null,
    'border' => null,
])
@switch($attributes->get('type'))
    @case('select')
        @if ($multiple)
            <div x-data="{
                options: [],
                selected: [],
                @isset($selected)
                        preSelected: @js($selected),
                    @else
                        preSelected: [],
                    @endisset
            
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index, event) {
                    if (!this.options[index].selected) {
                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);
            
                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
            
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', this.selectedValues());
                },
            
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);
            
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', this.selectedValues());
                },
            
                loadOptions() {
            
            
                    const optionsArray = @js($options);
            
                    let i = 0;
            
                    for (var key in optionsArray) {
                        this.options.push({
                            value: key,
                            text: optionsArray[key],
                            selected: this.preSelected.includes(key) ? true : false,
                        });
                        if (this.preSelected.includes(key)) {
                            this.selected.push(i);
                        }
                        i++;
                    };
            
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', this.selectedValues());
                },
            
                selectedValues() {
                    return this.selected.map((option) => {
                        return this.options[option].value;
                    })
                }
            }" class="flex flex-col items-center w-full mx-auto md:w-1/2">
                <div x-init="loadOptions()">
                    <input x-ref="{{ $id }}" id="{{ $id }}" type="hidden" x-bind:value="selectedValues()"
                        {{ $attributes->merge() }}>
                    <div class="relative inline-block w-64">
                        <div class="relative flex flex-col items-center">
                            <div x-on:click="open" class="w-full">
                                <div class="flex p-1 my-2 bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex flex-wrap flex-auto">
                                        <template x-for="(option,index) in selected" :key="options[option].value">
                                            <div
                                                class="flex items-center justify-center px-1 py-1 m-1 font-medium bg-gray-100 border rounded">
                                                <div class="flex-initial max-w-full text-xs font-bold leading-none capitalize"
                                                    x-model="options[option]" x-text="options[option].text"></div>
                                                <div class="flex flex-row-reverse flex-auto">
                                                    <div x-on:click.stop="remove(index,option)">
                                                        <svg class="w-4 h-4 fill-current " role="button" viewBox="0 0 20 20">
                                                            <path
                                                                d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                            C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                        </svg>

                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div x-show="selected.length == 0" class="flex-1">
                                            <input placeholder="Select an option"
                                                class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                x-bind:value="selectedValues()">
                                        </div>
                                    </div>
                                    <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">

                                        <button type="button" x-show="isOpen() === true" @click="open"
                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z" />
                                            </svg>
                                        </button>
                                        <button type="button" x-show="isOpen() === false" @click="close"
                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                            <svg version="1.1" class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25L17.418,6.109z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div x-show.transition.origin.top="isOpen()"
                                    class="absolute left-0 z-40 w-full px-2 py-4 bg-white rounded-lg shadow-lg top-100 max-h-select"
                                    @click.away="close">
                                    <div class="flex flex-col w-full overflow-y-auto">
                                        <template x-for="(option,index) in options" :key="index"
                                            class="overflow-auto">
                                            <div class="w-full rounded-md cursor-pointer hover:bg-gray-100"
                                                @click="select(index,$event);">
                                                <div
                                                    class="flex w-full items-center py-2 px-4 relative text-[#7b809a] hover:text-[#344767]">
                                                    <div class="flex items-center justify-between w-full">
                                                        <div class="mx-2 leading-6" x-model="option" x-text="option.text">
                                                        </div>
                                                        <div x-show="option.selected">
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                <path
                                                                    d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div x-data="{
                options: [],
                selected: [],
                @isset($selected)
                        preSelected: @js($selected),
                    @else
                        preSelected: [],
                    @endisset
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index) {
                    this.selected = this.options[index].text;
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', this.options[index].value);
                },
            
                loadOptions() {
                    const optionsArray = @js($options);
            
                    for (var key in optionsArray) {
                        this.options.push({
                            value: key,
                            text: optionsArray[key],
                        });
                        if ((this.preSelected.length > 0) && (this.preSelected.includes(key))) {
                            this.selected = optionsArray[key];
                            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', key);
                        }
                    }
                },
            
            
            }" class="flex flex-col items-center w-full mx-auto md:w-1/2">
                <div x-init="loadOptions()">
                    <input x-ref="{{ $id }}" id="{{ $id }}" type="hidden" {{ $attributes->merge() }}>
                    <div class="relative inline-block w-64">
                        <div class="relative flex flex-col items-center">
                            <div @click="open" class="w-full">
                                <div class="flex p-1 my-2 bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex flex-wrap flex-auto">
                                        <div x-show="selected.length == 0">
                                            <input placeholder="Select an option"
                                                class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none">
                                        </div>
                                        <div x-show="selected.length > 0">
                                            <div class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                x-text="selected"></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300">
                                        <button type="button" x-show="isOpen() === true" @click="open"
                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z" />
                                            </svg>
                                        </button>
                                        <button type="button" x-show="isOpen() === false" @click="close"
                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                            <svg version="1.1" class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25L17.418,6.109z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div x-show.transition.origin.top="isOpen()"
                                    class="absolute left-0 z-40 w-full px-2 py-4 bg-white rounded-lg shadow-lg top-100 max-h-select "
                                    @click.away="close">
                                    <div class="flex flex-col w-full overflow-y-auto">
                                        <template x-for="(option,index) in options" :key="option.value"
                                            class="overflow-auto">
                                            <div class="w-full rounded-md cursor-pointer hover:bg-gray-100"
                                                @click="close; select(index)">
                                                <div
                                                    class="flex w-full items-center py-2 px-4 relative text-[#7b809a] hover:text-[#344767]">
                                                    <div class="flex items-center justify-between w-full">
                                                        <div class="mx-2 leading-6" x-model="option" x-text="option.text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @break

    @case('toggle')
        <div x-data="{ toggle:
                            @if ($attributes->whereStartsWith('wire:model')->first()) @entangle($attributes->whereStartsWith('wire:model')->first())
                    @else
                        false @endif
                        }" class="inline-flex items-center">
            <div class="relative inline-block w-8 h-4 rounded-full cursor-pointer">
                <input
                    class="absolute w-8 h-4 transition-colors duration-300 rounded-full appearance-none cursor-pointer peer bg-blue-gray-100 checked:bg-black peer-checked:border-black peer-checked:before:bg-black {{ $attributes->get('class') }}"
                    type="checkbox" id="{{ $id }}"
                    data-attribute="toggle"
                    {{ $attributes->merge() }} @click="toggle = !toggle" />
                <label
                    for="{{ $id }}"
                    class="before:content[''] absolute top-2/4 -left-1 h-5 w-5 -translate-y-2/4 cursor-pointer rounded-full border border-blue-gray-100 bg-white shadow-md transition-all duration-300 before:absolute before:top-2/4 before:left-2/4 before:block before:h-10 before:w-10 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10 peer-checked:translate-x-full peer-checked:border-black peer-checked:before:bg-black {{ $attributes->get('labelClass') }}"
                >
                    <div class="inline-block p-5 rounded-full top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4" :checked="toggle" data-ripple-dark="true"></div>
                </label>
            </div>
            @if ($label)
                <label @class([
                    'mt-px mb-0 ml-3 font-light cursor-pointer select-none',
                    $textColor ? $textColor : 'text-gray-700',
                    $attributes->get('labelClass'),
                ])>
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @case('datepicker')
        <div x-data="{
            showDatepicker: false,
            datepickerValue: @entangle($attributes->whereStartsWith('wire:model')->first()),
            selectedDate: @entangle($attributes->whereStartsWith('wire:model')->first()),
            dateFormat: '{{ $dateFormat }}',
            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
        
            MONTH_NAMES: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ],
        
            MONTH_SHORT_NAMES: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
        
            DAYS: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        
            initDate() {
                let today;
        
                if (this.selectedDate) {
                    today = new Date(Date.parse(this.selectedDate));
                } else {
                    today = new Date();
                }
        
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = this.formatDateForDisplay(today);
            },
        
            formatDateForDisplay(date) {
                let formattedDay = this.DAYS[date.getDay()];
                let formattedDate = ('0' + date.getDate()).slice(-2);
                let formattedMonth = this.MONTH_NAMES[date.getMonth()];
                let formattedMonthShortName = this.MONTH_SHORT_NAMES[date.getMonth()];
                let formattedMonthInNumber = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
                let formattedYear = date.getFullYear();
        
                if (this.dateFormat === 'DD-MM-YYYY') {
                    return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`;
                }
        
                if (this.dateFormat === 'YYYY-MM-DD') {
                    return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`;
                }
        
                if (this.dateFormat === 'D d M, Y') {
                    return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`;
                }
        
                return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
            },
        
            isSelectedDate(date) {
                const d = new Date(this.year, this.month, date);
        
                return this.datepickerValue === this.formatDateForDisplay(d) ? true : false;
            },
        
            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);
        
                return today.toDateString() === d.toDateString() ? true : false;
            },
        
            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date);
                this.datepickerValue = this.formatDateForDisplay(selectedDate);
                this.isSelectedDate(date);
                this.showDatepicker = false;
            },
        
            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
        
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }
        
                let daysArray = [];
        
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }
        
                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            },
        
        }" x-init="[initDate(), getNoOfDays()]" @click.away="showDatepicker = false">
            <div class="container px-4 py-2 mx-auto md:py-10">
                <div class="w-64 mb-5">
                    <label for="datepicker" class="block mb-1 font-bold text-gray-700">Select Date</label>
                    <div class="relative">
                        <input type="hidden" x-ref="date" :value="datepickerValue" />
                        <input type="text" x-on:click="showDatepicker = !showDatepicker" x-model="datepickerValue"
                            x-on:keydown.escape="showDatepicker = false"
                            class="w-full py-3 pl-4 pr-10 font-medium leading-none text-gray-600 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                            placeholder="Select date" readonly />

                        <div class="absolute top-0 right-0 px-3 py-2" x-on:click="showDatepicker = !showDatepicker">
                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <template x-if="showDatepicker">
                            <div class="absolute top-0 left-0 z-50 p-2 mt-12 bg-white rounded-lg shadow" style="width: 17rem">
                                <div class="flex items-center justify-between mb-2">
                                    <button type="button"
                                        class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100"
                                        @click="
                                        if (month == 0) {
                                            year--;
                                            month = 12;
                                        } 
                                        month--; getNoOfDays()
                                    ">
                                        <svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <div>
                                        <span x-text="MONTH_NAMES[month]" class="text-xl font-light text-gray-800"></span>
                                        <span x-text="year" class="ml-1 text-lg font-normal text-gray-600"></span>
                                    </div>
                                    <button type="button"
                                        class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100"
                                        @click="
                                        if (month == 11) {
                                            month = 0; 
                                            year++;
                                        } else {
                                            month++; 
                                        } getNoOfDays()
                                    ">
                                        <svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex flex-wrap mb-3 -mx-1">
                                    <template x-for="(day, index) in DAYS" :key="index">
                                        <div style="width: 14.26%" class="px-0.5">
                                            <div x-text="day" class="text-xs font-medium text-center text-gray-500">
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <div class="flex flex-wrap -mx-1">
                                    <template x-for="blankday in blankdays">
                                        <div style="width: 14.28%" class="p-1 text-sm text-center border border-transparent">
                                        </div>
                                    </template>
                                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                        <div style="width: 14.28%" class="px-1 mb-1">
                                            <div @click="getDateValue(date)" x-text="date"
                                                class="cursor-pointer text-center text-sm text-[#393939] font-normal h-[2.4375rem] w-[2.4375rem] rounded-full !leading-[2.4375rem] transition ease-in-out duration-100"
                                                :class="{
                                                    'bg-[#e91e63] text-white': isToday(date) == true,
                                                    'text-[#393939] hover:bg-blue-600 hover:bg-opacity-25': isToday(
                                                        date) == false && isSelectedDate(date) == false,
                                                    'bg-[#e91e63] text-white hover:bg-opacity-75': isSelectedDate(
                                                        date) == true
                                                }">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    @break

    @case('timepicker')
        <div x-data="{
            timepickerValue: @entangle($attributes->whereStartsWith('wire:model')->first()),
            selectedHour: '12',
            selectedMinute: '00',
            selectedAmPm: 'pm',
            showTimepicker: false,
            close() {
                this.showTimepicker = false;
            },
            update() {
                if (this.selectedMinute < 10 & this.selectedMinute.length < 2) {
                    this.selectedMinute = '0' + this.selectedMinute;
                }
                time12h = this.selectedHour + ':' + this.selectedMinute + ' ' + this.selectedAmPm;
                this.timepickerValue = this.convertTime12to24(time12h);
            },
            changeAmPm() {
                if (this.selectedAmPm == 'am') {
                    this.selectedAmPm = 'pm';
                } else {
                    this.selectedAmPm = 'am';
                }
                this.update();
            },
            convertTime12to24(time12h) {
                const [time, modifier] = time12h.split(' ');
                let [hours, minutes] = time.split(':');
                if (hours === '12') {
                    hours = '00';
                }
                if (modifier === 'pm') {
                    hours = parseInt(hours, 10) + 12;
                }
                return `${hours}:${minutes}`;
            },
        }">
            <div class="w-fit" @click.away="close()">
                <input x-ref="{{ $id }}" id="{{ $id }}"
                    class="px-1 py-2 text-gray-800 bg-transparent bg-white border border-gray-200 rounded-lg shadow-sm outline-none appearance-none cursor-pointer hover:bg-grey-100"
                    :value="timepickerValue" @click="showTimepicker = !showTimepicker" />
                <template x-if="showTimepicker">
                    <div class="relative block py-1 w-fit">
                        <div class="flex relative rounded-lg shadow-lg p-0.5 border border-gray-200">
                            <input type="number" min="1" max="12" step="1" class="ml-3 text-center"
                                x-model="selectedHour" @click="update()" />

                            <span class="px-1 py-2 text-gray-800 outline-none appearance-none">:</span>

                            <input type="number" min="0" max="59" step="5" class="text-center"
                                x-model="selectedMinute" @click="update()" />

                            <div @click="changeAmPm()"
                                class="px-1 py-2 mr-3 text-gray-800 uppercase bg-transparent bg-white outline-none appearance-none cursor-pointer hover:bg-grey-100"
                                x-text="selectedAmPm"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    @break

    @case('number')
        <div wire:ignore class="relative h-11 w-full min-w-[200px]">
            <input
                @class([
                    "peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-black focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType != 'outline'),
                    "peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType == 'outline'),
                    $attributes->get('class'),
                ])
                id="{{ $id }}" 
                type="number"
                placeholder="{{ $attributes->get('placeholder') ?? ' ' }}"
                {{ $attributes->merge() }}
            />
            @if ($label)
                <label 
                    @class([
                        "after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'static',
                        "after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'standard',
                        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'outline',
                        $attributes->get('labelClass'),
                    ]) 
                    for="{{ $id }}"
                >
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @case('email')
        <div wire:ignore class="relative h-11 w-full min-w-[200px]">
            <input
                @class([
                    "peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-black focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType != 'outline'),
                    "peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType == 'outline'),
                    $attributes->get('class'),
                ])
                id="{{ $id }}" 
                type="email"
                placeholder="{{ $attributes->get('placeholder') ?? ' ' }}"
                {{ $attributes->merge() }}
            />
            @if ($label)
                <label 
                    @class([
                        "after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'static',
                        "after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'standard',
                        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'outline',
                        $attributes->get('labelClass'),
                    ]) 
                    for="{{ $id }}"
                >
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @case('counter')
        <div x-data="{ counter:
                            @if ($attributes->whereStartsWith('wire:model')->first()) @entangle($attributes->whereStartsWith('wire:model')->first())
                    @else
                        0 @endif
                        }" class="flex items-center py-2 pl-3 border rounded-md border-slate-800 border-opacity-30 w-max">
            <button
                class="w-6 h-6 flex items-center justify-center border rounded-full p-4 text-2xl hover:text-white hover:bg-[#e91e63] transition mr-3"
                @click="counter--">
                –
            </button>

            <input
                class="w-1/3 py-3 pl-4 pr-10 font-medium leading-none text-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                type="number" id="{{ $id }}" :value="counter" {{ $attributes->merge() }} />

            <button
                class="w-6 h-6 flex items-center justify-center border rounded-full p-4 text-2xl hover:text-white hover:bg-[#e91e63] transition ml-3"
                @click="counter++">
                +
            </button>
        </div>
    @break

    @case('file')
        <input class="bg-white min-h-[150px] rounded-lg w-full p-5" id="{{ $id }}" type="file"
            {{ $attributes->merge() }} />
    @break

    @case('textarea')
        <div wire:ignore class="relative w-full min-w-[200px]">
            <textarea
                @class([
                    "peer h-full min-h-[100px] w-full resize-none border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-black focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50" => ($inputType != 'outline'),
                    "peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50" => ($inputType == 'outline'),
                    $attributes->get('class'),
                ])
                id="{{ $id }}" 
                type="textarea"
                placeholder="{{ $attributes->get('placeholder') ?? ' ' }}"
                {{ $attributes->merge() }}
            ></textarea>
            @if ($label)
                <label 
                    @class([
                        "after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'static',
                        "after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-0 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'standard',
                        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'outline',
                        $attributes->get('labelClass'),
                    ]) 
                    for="{{ $id }}"
                >
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @case('range')
        @if ($label)
            <label class="block mb-2 text-sm font-medium text-gray-900"
                for="{{ $id }}">{!! $label !!}</label>
        @endif
        <input id="{{ $id }}" type="range" class="cursor-pointer h-[3px] border-none border-transparent "
            {{ $attributes->merge() }} />
    @break

    @case('checkbox')
        <label class="inline-flex items-center">
            <label
                class="relative flex items-center p-3 rounded-full cursor-pointer"
                for="{{ $id }}"
                data-ripple-dark="true"
            >
                <input
                    id="{{ $id }}"
                    type="checkbox"
                    @class([
                        "before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10",
                        $color ? $color : 'checked:bg-black checked:before:bg-black',
                        $border ? $border : 'checked:border-black',
                        $attributes->get('class'),
                    ])
                    {{ $attributes->merge() }}
                />
                <div class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        stroke="currentColor"
                        stroke-width="1"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </label>
            <label @class([
                'mt-px font-light cursor-pointer select-none',
                $textColor ? $textColor : 'text-gray-700',
                $attributes->get('labelClass'),
            ])>
                {!! $label !!}
            </label>
        </label>
    @break

    @case('radio')
        <div 
            class="inline-flex items-center"
        >
            <label
                class="relative flex items-center p-3 rounded-full cursor-pointer"
                for="{{ $id }}"
                data-ripple-dark="true"
            >
                <input
                    @class([
                        "before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10",
                        $color ? $color : 'checked:before:bg-black',
                        $border ? $border : 'checked:border-black',
                        $textColor ? $textColor : 'text-black',
                        $attributes->get('class'),
                    ])
                    type="radio"
                    id="{{ $id }}"
                    {{ $attributes->merge() }}
                />
                <div 
                    @class([
                        'absolute transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100',
                        $color ? $color : 'text-black',
                    ])>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                    >
                        <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                    </svg>
                </div>
            </label>
            @if ($label)
                <label @class([
                    'mt-px font-light cursor-pointer select-none',
                    $textColor ? $textColor : 'text-gray-700',
                    $attributes->get('labelClass'),
                ]) for="{{ $id }}">
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @case('password')
        <div wire:ignore class="relative h-11 w-full min-w-[200px]">
            <input
                @class([
                    "peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-black focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType != 'outline'),
                    "peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType == 'outline'),
                    $attributes->get('class'),
                ])
                id="{{ $id }}" 
                type="password"
                placeholder="{{ $attributes->get('placeholder') ?? ' ' }}"
                {{ $attributes->merge() }}
            />
            @if ($label)
                <label 
                    @class([
                        "after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'static',
                        "after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'standard',
                        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'outline',
                        $attributes->get('labelClass'),
                    ]) 
                    for="{{ $id }}"
                >
                    {!! $label !!}
                </label>
            @endif
        </div>
    @break

    @default
        <div wire:ignore class="relative h-11 w-full min-w-[200px]">
            <input
                @class([
                    "peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-black focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType != 'outline'),
                    "peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" => ($inputType == 'outline'),
                    $attributes->get('class'),
                ])
                id="{{ $id }}" 
                type="text"
                placeholder="{{ $attributes->get('placeholder') ?? ' ' }}"
                {{ $attributes->merge() }}
            />
            @if ($label)
                <label 
                    @class([
                        "after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'static',
                        "after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-black after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:after:scale-x-100 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'standard',
                        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500" => $inputType == 'outline',
                        $attributes->get('labelClass'),
                    ]) 
                    for="{{ $id }}"
                >
                    {!! $label !!}
                </label>
            @endif
        </div>
@endswitch
