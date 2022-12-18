<script setup>
import { defineProps, ref, reactive, watch  } from "vue";
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import FlashMessage from '@/Components/FlashMessage.vue';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    "users": Array,
    "flash": Object,
})
const dragIndex = ref(null);
let form = useForm({users: props.users});

const pushUser = () => {
  form.users.push({
    id: 0,
    name: "",
    username: "",
    email: "",
    is_email_verified: false,
  });
};

const dragStart = (index) => {
  dragIndex.value = index;
};

const dragEnter = (index) => {
  if (index === dragIndex.value) return;
  const deleteElement = form.users.splice(dragIndex.value, 1)[0];
  form.users.splice(index, 0, deleteElement);
  dragIndex.value = index;
};

const dragEnd = (ev) => {
  dragIndex.value = null;
};

const sendUsers = () => {
  form.patch(route('users.multiupdate'), {
    onSuccess: () => form = useForm({users: props.users})
  });
};
</script>

<template>
  <Head>
    <title>ユーザー一覧</title>
  </Head>

  <AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
          <button @click="pushUser">ユーザーを追加</button>
          <button @click="sendUsers" :disabled="form.processing">変更を確定する</button>
          <FlashMessage :flash="props.flash" />
          <InputError v-if="Object.keys(form.errors).length !== 0" message="入力エラーがあります。未保存です。" />
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>ログイン可能</th>
                <th>名前</th>
                <th>ユーザ名</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(user, index) in form.users"
                :key="index"
                :draggable="true"
                @dragstart="dragStart(index)"
                @dragenter="dragEnter(index)"
                @dragover.prevent
                @dragend="dragEnd"
                :class="index === dragIndex ? 'dragging' : ''"
              >
                <td>{{ user.id !== 0 ? user.id : null }}</td>
                <td><input type="checkbox" v-model="user.is_email_verified" /></td>
                <td>
                  <input type="text" v-model="user.name" />
                  <InputError :message="form.errors[`users.${index}.name`]" />
                </td>
                <td>
                  <input type="text" v-model="user.username" />
                  <InputError :message="form.errors[`users.${index}.username`]" />
                </td>
                <td>
                  <input type="text" v-model="user.email" />
                  <InputError :message="form.errors[`users.${index}.email`]" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
table,
th,
td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 1em;
}
.dragging {
  background-color: #aaa;
}
</style>