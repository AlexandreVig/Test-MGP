<script setup lang="ts">
import type { User } from "@/types/user";
import apiClient from "@/utils/apiClient";
import { ElButton, ElCard } from "element-plus";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const user = ref<User | null>(null);
const router = useRouter();

const fetchUser = async () => {
  try {
    const token = localStorage.getItem("token");
    if (!token) return redirectToLogin();

    const response = await apiClient.get<User>("/auth/me");
    user.value = response.data;
  } catch (error: any) {
    if (error.response?.status === 401) {
      redirectToLogin();
    }
  }
};

const redirectToLogin = () => {
  localStorage.removeItem("token");
  router.replace("/login");
};

const onLogout = () => {
  redirectToLogin();
};

onMounted(fetchUser);
</script>

<template>
  <ElCard class="form-card" header="Authenticated user">
    <p v-if="user">
      You are authenticated as <strong>{{ user.email }}</strong> with ID <strong>{{ user.id }}</strong>.
    </p>
    <p v-else>Loading user information...</p>
    <template #footer>
      <ElButton @click="onLogout">Log out</ElButton>
    </template>
  </ElCard>
</template>
