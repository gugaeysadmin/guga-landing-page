<template>
    <h1>hola mundo</h1>
    <nav>
        <div>
            <router-link to="/app/homevue">Home</router-link>
            <router-link to="/app/aboutvue">About</router-link>
        </div>
        <main>
            <router-view/>
        </main>
    </nav>
</template>
