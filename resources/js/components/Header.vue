<template>
    <div class="flex flex-row h-36 px-6 md:pr-14 justify-end items-center">
        <div>
            <a href="/" class="flex flex-row gap-3 items-center rounded-2xl border-[3px] border-[#4180ab] px-4 py-2 group transition-all transition=300 hover:bg-[#4180ab]">
                <div>
                    <i class="bi bi-eye-fill text-xl text-[#4180ab] group-hover:text-white transition transition-300"></i>
                </div>
                <div>
                    <h1 class="font-bold text-sm text-[#4180ab] group-hover:text-white transition transition-300">VER LA PAGINA</h1>
                </div>
            </a>
        </div>
        <!-- <img :src="'/img/logo_normal.png'" alt="Logo"> -->
    </div>
</template>

<script>
    export default {
        name: "Header"
    }
</script>