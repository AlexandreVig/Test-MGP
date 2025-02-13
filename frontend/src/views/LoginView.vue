<script setup lang="ts">
import type { userAuthentification } from "@/types/authentification";
import apiClient from "@/utils/apiClient";
import type { AxiosError } from "axios";
import {
  ElButton,
  ElCard,
  ElForm,
  ElFormItem,
  ElInput,
  ElNotification,
  type FormInstance,
  type FormRules,
} from "element-plus";
import { ref } from "vue";
import { useRouter } from "vue-router";

const userData = ref<userAuthentification>({
  email: "",
  password: "",
});

const router = useRouter();
const formRef = ref<FormInstance>();

const rules: FormRules<userAuthentification> = {
  email: [
    { required: true, message: "E-mail is required", trigger: "blur" },
    {
      type: "email",
      message: "Invalid e-mail format",
      trigger: ["blur", "change"],
    },
  ],
  password: [
    { required: true, message: "Password is required", trigger: "blur" },
    {
      min: 6,
      message: "Password must be at least 6 characters",
      trigger: "blur",
    },
  ],
};

const onSubmit = async () => {
  try {
    const isValid = await formRef.value?.validate();
    if (!isValid) return;

    const response = await apiClient.post("/auth/login", userData.value);
    if (response.status === 200) {
      localStorage.setItem("token", response.data.token);
      router.push("/");
    }
  } catch (error) {
    const axiosError = error as AxiosError<{ message?: string }>;
    ElNotification({
      title: "Login Failed",
      message:
        axiosError.response?.data?.message ||
        "An error occurred. Please try again.",
      type: "error",
    });
  }
};
</script>

<template>
  <ElCard class="form-card" header="Login">
    <ElForm
      ref="formRef"
      :model="userData"
      :rules="rules"
      label-position="top"
      label-width="auto"
      size="large"
      @keyup.enter="onSubmit"
    >
      <ElFormItem label="E-mail" prop="email">
        <ElInput v-model="userData.email" type="email" />
      </ElFormItem>
      <ElFormItem label="Password" prop="password">
        <ElInput v-model="userData.password" type="password" show-password />
      </ElFormItem>
      <ElFormItem class="submit-container">
        <ElButton type="primary" @click="onSubmit">Submit</ElButton>
        <RouterLink to="/register">Don't have an account yet ?</RouterLink>
      </ElFormItem>
    </ElForm>
  </ElCard>
</template>
