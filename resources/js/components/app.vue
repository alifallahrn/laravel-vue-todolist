<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="pt-2 pb-2">
          <h2>
            <div
              v-if="loading"
              class="spinner-border"
              style="
                font-size: 11px;
                width: 24px;
                height: 24px;
                margin-right: 5px;
              "
              role="status"
            >
              <span class="visually-hidden">Loading...</span>
            </div>
            <svg
              v-else
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="currentColor"
              class="bi bi-check2-square"
              viewBox="0 0 16 16"
            >
              <path
                d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"
              />
              <path
                d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"
              />
            </svg>
            <span>Todo List</span>
          </h2>
          <div class="mt-2">
            <task-add :tasks="tasks" v-on:updateTasksList="getTasksList()" />
          </div>
        </div>
        <div class="mt-2">
          <task-list
            :tasks="tasks"
            :loading="loading"
            v-on:updateTasksList="getTasksList()"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import taskAdd from "./task/add.vue";
import taskList from "./task/list.vue";
export default {
  components: { taskAdd, taskList },
  data: function () {
    return {
      tasks: [],
      loading: false,
    };
  },
  methods: {
    getTasksList() {
      this.loading = true;
      axios
        .get("api/tasks")
        .then((response) => {
          this.tasks = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getTasksList();
  },
};
</script>
