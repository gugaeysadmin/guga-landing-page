<template>
    <div class="flex flex-row h-36 px-6 md:pr-24 justify-end items-center">
        <div>
            <a href="/" class="flex flex-row gap-3 items-center rounded-2xl border-[3px] border-slate-500 px-4 py-3 group transition-all transition=300 hover:bg-slate-700">
                <div>
                    <i class="bi bi-eye-fill text-2xl group-hover:text-white transition transition-300"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg group-hover:text-white transition transition-300">VER LA PAGINA</h1>
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