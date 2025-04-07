<template>
    <h1>hola mundo</h1>
    <nav>
        <div>
            <router-link to="/homevue">Home</router-link>
            <router-link to="/aboutvue">About</router-link>
        </div>
        <main>
            <router-view/>
        </main>
    </nav>
</template>
