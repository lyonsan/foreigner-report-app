<template>
  <nav class="navbar">
    <div class="navbar__menu">
      <span class="navbar__item">
        username
      </span>
      <div class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login
        </RouterLink>
        <RouterLink class="button button--link" to="/register">
          Register
        </RouterLink>
      </div>
    </div>
  </nav>
</template>