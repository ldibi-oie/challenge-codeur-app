<template>
  <div>
    <Navbar />
    <div class="container px-4 pt-24 mx-auto md:pt-32 lg:px-0 dark:bg-gray-900">
      <h1
        class="mb-3 text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white"
      >
        Notre plan de tarification simplifié
      </h1>
      <p
        class="mb-6 text-lg font-normal text-gray-500 sm:text-xl dark:text-gray-400"
      >
        Tous les types d'entreprises ont besoin d'accéder aux ressources de
        développement, c'est pourquoi nous vous donnons la possibilité de
        décider de la quantité dont vous avez besoin.
      </p>
      <PricingCard :is_company="is_company" :user="user"/>
      
      <!-- Comparison Table -->
      <section class="flex flex-col pt-10 md:pt-20">
        <div class="overflow-x-auto rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow sm:rounded-lg">
              <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                  <tr>
                    <th scope="col" class="p-4 text-left"></th>
                    <th
                      scope="col"
                      class="p-4 text-base font-semibold tracking-wider text-right text-gray-900 dark:text-white"
                    >
                      Freelancer
                    </th>
                    <th
                      scope="col"
                      class="p-4 text-base font-semibold tracking-wider text-right text-gray-900 dark:text-white"
                    >
                      Enterprise
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Seperate business/personal
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr class="bg-gray-50 dark:bg-gray-900">
                    <td
                      class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                    >
                      Estimate tax payments
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Stock control
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr class="bg-gray-50 dark:bg-gray-900">
                    <td
                      class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                    >
                      Create invoices &amp; estimates
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Manage bills &amp; payments
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr class="bg-gray-50 dark:bg-gray-900">
                    <td
                      class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                    >
                      Run payroll
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Handle multiple currencies
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr class="bg-gray-50 dark:bg-gray-900">
                    <td
                      class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                    >
                      Number of Users
                    </td>
                    <td class="p-4">
                      <div class="flex items-center justify-end space-x-1">
                        <svg
                          class="flex-shrink-0 w-5 h-5 text-gray-900 dark:text-white"
                          fill="currentColor"
                          viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"
                          ></path>
                        </svg>
                        <span
                          class="flex-shrink-0 text-xs font-medium text-gray-900 sm:text-sm md:text-base dark:text-white"
                          >1 User</span
                        >
                      </div>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <div class="flex items-center justify-end space-x-1">
                        <svg
                          class="flex-shrink-0 w-5 h-5 text-gray-900 dark:text-white"
                          fill="currentColor"
                          viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                          ></path>
                        </svg>
                        <span
                          class="flex-shrink-0 text-xs font-medium text-gray-900 sm:text-sm md:text-base dark:text-white"
                          >2+ Users</span
                        >
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Track deductible mileage
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr class="bg-gray-50 dark:bg-gray-900">
                    <td
                      class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
                    >
                      Track employee time
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                  <tr>
                    <td
                      class="p-4 text-base font-normal text-gray-500 rounded-l-lg whitespace-nowrap dark:text-gray-400"
                    >
                      Multi-device
                    </td>
                    <td class="p-4">
                      <svg
                        class="w-5 h-5 ml-auto text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                    <td class="p-4 rounded-r-lg">
                      <svg
                        class="w-5 h-5 ml-auto text-green-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import Navbar from "../../components/General/Navbar.vue";

import {
  getLoggedUser,
  isCompany,
  getUser,
} from "../../stores/usersFunction";
import PricingCard from "./PricingCard.vue";

export default {
  data() {
    return {
      user: "",
      is_registered_user: false,
      is_company: false,
    };
  },
  mounted() {
    getUser();
    this.user = getLoggedUser();
    this.is_company = isCompany(this.user);
  },
  methods: {},
  components: { Navbar, PricingCard },
};
</script>
