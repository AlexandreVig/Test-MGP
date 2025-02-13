<script setup lang="ts">
import type { userAuthentification } from "@/types/authentification";
import apiClient from "@/utils/apiClient";
import type { AxiosError } from "axios";
import {
  ElButton,
  ElCard,
  ElCheckbox,
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

interface Validation {
  rule: string;
  test: (value: string) => boolean;
  isValid: boolean;
}

const router = useRouter();
const formRef = ref<FormInstance>();
const passwordValidation: Validation[] = [
  {
    rule: "Password must be at least 8 characters long",
    isValid: false,
    test: (value) => value.length >= 8,
  },
  {
    rule: "Password must contain at least one uppercase letter",
    isValid: false,
    test: (value) => /[A-Z]/.test(value),
  },
  {
    rule: "Password must contain at least one lowercase letter",
    isValid: false,
    test: (value) => /[a-z]/.test(value),
  },
  {
    rule: "Password must contain at least one special character",
    isValid: false,
    test: (value) => /[\W_]/.test(value),
  },
];

const validatePassword = (rule: any, value: string, callback: Function) => {
  if (!value) {
    passwordValidation.forEach((item) => (item.isValid = false));
    return callback(new Error("Password is required"));
  }

  let valid = true;
  passwordValidation.forEach((item) => {
    item.isValid = item.test(value);
    valid = valid && item.isValid;
  });

  if (!valid) {
    return callback(new Error(""));
  }
  callback();
};

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
    { validator: validatePassword, trigger: ["blur", "change"] },
  ],
};

const onSubmit = async () => {
  try {
    const isValid = await formRef.value?.validate();
    if (!isValid) return;

    const response = await apiClient.post("/auth/login", userData.value);
    if (response && response.status === 201) {
      router.push("/login");
      ElNotification({
        title: "User registered",
        message:
          "You've been successfully registered, you can now log into your new account",
        type: "success",
      });
    }
  } catch (error) {
    const axiosError = error as AxiosError<{ message?: string }>;
    ElNotification({
      title: "Register Failed",
      message:
        axiosError.response?.data?.message ||
        "An error occurred. Please try again.",
      type: "error",
    });
  }
};
</script>

<template>
  <ElCard class="form-card" header="Register">
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
        <div class="password-validation">
          <ElCheckbox
            v-for="(item, index) in passwordValidation"
            :key="index"
            :label="item.rule"
            :model-value="item.isValid"
            size="small"
          ></ElCheckbox>
        </div>
      </ElFormItem>
      <ElFormItem class="submit-container">
        <ElButton type="primary" @click="onSubmit">Submit</ElButton>
        <RouterLink to="/login">Already have an account ?</RouterLink>
      </ElFormItem>
    </ElForm>
  </ElCard>
</template>
