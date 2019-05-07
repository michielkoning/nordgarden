<template>
  <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/tour">Tour</router-link>
    <router-link to="/albums">Albums</router-link>
    <router-link to="/videos">Videos</router-link>
  </nav>
</template>

<style>
nav {
  display: flex;
  justify-content: center;
}

a {
  margin: 0 1em;
}
</style>
