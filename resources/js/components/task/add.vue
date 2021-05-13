<template>
  <div class="add-task">
    <div class="row g-2">
      <div class="col-9">
        <input
          type="text"
          v-model="task.title"
          class="form-control"
          placeholder="Enter task title ..."
        />
      </div>
      <div class="col-3 d-grid">
        <button
          type="button"
          :class="[
            task.title ? 'btn-success text-light' : 'btn-secondary disabled',
            'btn text-start',
          ]"
          @click="addTask()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-plus-square-fill"
            viewBox="0 0 16 16"
          >
            <path
              d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"
            ></path>
          </svg>
          Add Task
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["tasks"],
  data: function () {
    return {
      task: {
        title: "",
        completed: false,
      },
    };
  },
  methods: {
    addTask() {
      if (this.task.title == "") return;
      axios
        .post("api/task/store", {
          task: this.task,
        })
        .then((response) => {
          if (response.status == 201) {
            this.tasks.push({ title: this.task.title });
            this.task.title = "";
            this.$emit("updateTasksList");
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
