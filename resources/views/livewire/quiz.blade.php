<div>
    @if(! $finished)
        {{-- Header --}}
        <div class="w-full">
            <div class="h-[7px] bg-blue" style="width: {{ ($current_question->order / $question_count) * 100 }}%"></div>
            <div class="flex justify-between items-center mt-[16px] mx-[50px]">
                <button wire:click="previousQuestion" class="bg-gray p-[12px] rounded-full hover:opacity-90">
                    <svg xmlns="http://www.w3.org/2000/svg" height="28" width="26" viewBox="0 0 448 512">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </button>
                <div class="text-[18px] font-bold border border-gray rounded-full py-[8px] px-[16px]">{{ $current_question->order }}/{{ $question_count }}</div>
            </div>
        </div>

        {{-- Question --}}
        <div class="w-full max-w-[750px] mx-auto mt-[125px]">
            <h1 class="text-blue font-bold text-[36px] leading-[44px]">{{ $current_question->title }}</h1>
            <p class="text-black font-medium text-[36px] leading-[44px] mt-[8px]">{{ $current_question->description }}</p>
            <button wire:click="changeMoreInfo" class="relative flex items-center text-[22px] gap-[8px] py-[12px] px-[16px] border border-gray hover:border-darkgray rounded-[12px] mt-[24px]">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z" />
                </svg>
                <span>{{ __('Wat vinden de partijen?') }}</span>
            </button>
            @if ($more_info)
                <div class="mt-[16px] mb-[150px] w-[960px] bg-lightgray rounded-[16px] grid grid-cols-3 gap-[48px] p-[32px]">
                    <div class="w-full text-start">
                        <h3 class="text-green font-bold text-[22px]">{{ __('Eens') }}</h3>
                        <p class="text-black text-[14px]">{{ __('Deze partijen zijn het met de stelling eens') }}</p>
                        @foreach ($opinions_agree as $opinion)
                            <div class="bg-white w-full rounded-[4px] py-[16px] px-[20px] mt-[16px]">
                                <h3 class="text-[18px] font-bold text-black">{{ $opinion->party->name }}</h3>
                                <p class="text-[14px] text-black mt-[8px]">{{ $opinion->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full text-start">
                        <h3 class="text-black font-bold text-[22px]">{{ __('Geen van beide') }}</h3>
                        <p class="text-black text-[14px]">{{ __('Deze partijen zijn het niet eens en ook niet oneens met de stelling') }}</p>
                        @foreach ($opinions_neutral as $opinion)
                            <div class="bg-white w-full rounded-[4px] py-[16px] px-[20px] mt-[16px]">
                                <h3 class="text-[18px] font-bold text-black">{{ $opinion->party->name }}</h3>
                                <p class="text-[14px] text-black mt-[8px]">{{ $opinion->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full text-start">
                        <h3 class="text-red font-bold text-[22px]">{{ __('Oneens') }}</h3>
                        <p class="text-black text-[14px]">{{ __('Deze partijen zijn het met de stelling oneens') }}</p>
                        @foreach ($opinions_disagree as $opinion)
                            <div class="bg-white w-full rounded-[4px] py-[16px] px-[20px] mt-[16px]">
                                <h3 class="text-[18px] font-bold text-black">{{ $opinion->party->name }}</h3>
                                <p class="text-[14px] text-black mt-[8px]">{{ $opinion->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Buttons --}}
        <div class="fixed bottom-0 left-0 bg-white py-[24px] w-full flex justify-center items-center shadow-2xl shadow-black">
            <button wire:click="giveOpinion('agree')" class="text-[22px] leading-[22px] rounded-[16px] font-bold text-white bg-green flex items-center fill-white gap-[8px] py-[21px] px-[29px] border-[3px] border-green hover:opacity-95">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                    <path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z" />
                </svg>
                <span>{{ __('Eens') }}</span>
            </button>
            <hr class="border-t-[2px] border-gray w-[32px]">
            <button wire:click="giveOpinion('neutral')" class="text-[22px] leading-[22px] rounded-[16px] font-bold text-black bg-gray flex items-center fill-black gap-[8px] py-[21px] px-[29px] border-[3px] border-gray hover:opacity-95">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                    <path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z" />
                </svg>
                <span>{{ __('Geen van beide') }}</span>
            </button>
            <hr class="border-t-[2px] border-gray w-[32px]">
            <button wire:click="giveOpinion('disagree')" class="text-[22px] leading-[22px] rounded-[16px] font-bold text-white bg-red flex items-center fill-white gap-[8px] py-[21px] px-[29px] border-[3px] border-red hover:opacity-95">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                    <path d="M313.4 479.1c26-5.2 42.9-30.5 37.7-56.5l-2.3-11.4c-5.3-26.7-15.1-52.1-28.8-75.2H464c26.5 0 48-21.5 48-48c0-18.5-10.5-34.6-25.9-42.6C497 236.6 504 223.1 504 208c0-23.4-16.8-42.9-38.9-47.1c4.4-7.3 6.9-15.8 6.9-24.9c0-21.3-13.9-39.4-33.1-45.6c.7-3.3 1.1-6.8 1.1-10.4c0-26.5-21.5-48-48-48H294.5c-19 0-37.5 5.6-53.3 16.1L202.7 73.8C176 91.6 160 121.6 160 153.7V192v48 24.9c0 29.2 13.3 56.7 36 75l7.4 5.9c26.5 21.2 44.6 51 51.2 84.2l2.3 11.4c5.2 26 30.5 42.9 56.5 37.7zM32 384H96c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H32C14.3 96 0 110.3 0 128V352c0 17.7 14.3 32 32 32z" />
                </svg>
                <span>{{ __('Oneens') }}</span>
            </button>
        </div>
    @else
        <div class="w-full max-w-[500px] mx-auto">
            <h1 class="mb-[24px] text-center text-[32px] font-bold mt-[100px]">{{ __('Je resultaat voor de verkiezingen') }}</h1>
            @foreach ($user_opinions as $opinion)
                @php($percentage = intval(($opinion['opinion'] / $question_count) * 100))
                <div class="mt-[64px] flex justify-between items-center">
                    <p class="text-black text-[18px] font-medium w-full max-w-[125px]">{{ $opinion['name'] }}</p>
                    <div class="h-[20px] bg-blue/50 rounded-full w-full max-w-[275px]">
                        <div class="h-full bg-blue rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                    <p class="text-black text-[18px] font-medium w-full max-w-[50px] text-end">{{ $percentage }}%</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
