<template>
  <div class="w-full flex items-center justify-between rounded border-gray-600" :key="index">
    <div class="skeleton flex-1 p-2">
      &nbsp;
    </div>
    <span class="skeleton px-2 h-full cursor-pointer w-8 h-8 ">&nbsp;</span>
    <span class="skeleton px-2 h-full cursor-pointer w-8 h-8 ">&nbsp;</span>
  </div>
</template>

<style>
.skeleton {
  @apply text-opacity-0;
  background-image: linear-gradient(100deg, #edf2f7 0%, #f4f7fa 20%, #edf2f7 40%);
  background-position: 50%;
  background-size: 200%;
  animation: skeleton 1.5s infinite linear;
}
@keyframes skeleton {
  0% {
    background-position: 50%;
  }
  50%, 100% {
    background-position: -90%
  }
}
</style>
