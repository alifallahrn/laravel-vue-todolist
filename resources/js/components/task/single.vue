<template>
  <div class="col-12">
    <label :for="['task_' + task.id]">
      <input
        :id="['task_' + task.id]"
        class="form-check-input me-1"
        @change="updateTask()"
        v-model="task.completed"
        type="checkbox"
      />
      <span
        :class="[
          task.completed ? 'text-decoration-line-through text-secondary' : '',
        ]"
        >{{ task.title }}</span
      >
    </label>
    <button
      type="button"
      class="btn btn-sm p-0 float-end text-secondary"
      @click="removeTask()"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="12"
        height="12"
        fill="currentColor"
        class="bi bi-trash-fill"
        viewBox="0 0 16 16"
      >
        <path
          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
        ></path>
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  props: ["task", "tasks"],
  methods: {
    updateTask() {
      axios
        .put("api/task/" + this.task.id, {
          task: this.task,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$emit("taskupdated");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeTask() {
      if (!confirm("Are you sure?")) return;
      axios
        .delete("api/task/" + this.task.id, {
          task: this.task,
        })
        .then((response) => {
          if (response.status == 200) {
            this.tasks.splice(this.tasks.indexOf(this.task), 1);
            this.$emit("taskupdated");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
