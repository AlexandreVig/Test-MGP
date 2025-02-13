<script setup lang="ts">
import { ElContainer, ElHeader, ElMain } from "element-plus";
import { RouterLink } from "vue-router";
</script>

<template>
  <ElContainer>
    <ElHeader>
      <RouterLink to="/" class="header-title">
        <h1>Technical Test MGP - Vue3 + Symfony</h1>
      </RouterLink>
    </ElHeader>

    <ElMain>
      <RouterView />
    </ElMain>
  </ElContainer>
</template>
