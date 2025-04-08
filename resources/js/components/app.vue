<template>
    <header>
        <Header></Header>
    </header>
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
