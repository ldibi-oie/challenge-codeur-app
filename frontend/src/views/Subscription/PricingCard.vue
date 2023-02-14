<template>
  <!-- Pricing Cards -->
  <section
    class="grid grid-cols-1 space-y-12 md:space-y-0 md:grid-cols-2 lg:grid-cols-3 md:gap-x-6 md:gap-6 pt-9"
  >
    <!-- Pricing Card -->
    <div
      class="flex flex-col max-w-lg p-6 mx-auto text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white"
    >
      <h3 class="mb-4 text-2xl font-semibold">Monthly</h3>
      <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
        Abonnement mensuel récursif.
      </p>
      <div class="flex items-baseline my-8">
        <span v-if="is_company" class="mr-2 text-5xl font-extrabold">$39</span>
        <span v-if="!is_company" class="mr-2 text-5xl font-extrabold"
          >$9.99</span
        >
        <span class="text-gray-500 dark:text-gray-400">/month</span>
      </div>

      <ul role="list" class="mb-8 space-y-4 text-left">
        <li class="flex items-center space-x-3">
          <!-- Icon -->
          <svg
            class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400"
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
          <span>Abonnement mensuel </span>
        </li>
      </ul>

      <a
        v-if="is_company"
        href="https://buy.stripe.com/test_8wMdSH1Ceg30am4dQQ"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
          companyMonthText
        }}</a
      >
      <a
        v-if="!is_company"
        href="https://buy.stripe.com/test_14k8ynep05omeCkdQT"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
          freelanceMonthText
        }}</a
      >
    </div>
    <!-- Pricing Card -->
    <div
      class="flex flex-col max-w-lg p-6 mx-auto text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white"
    >
      <h3 class="mb-4 text-2xl font-semibold">6 Month</h3>
      <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
        Abonnement récursif de 6 mois.
      </p>
      <div class="flex items-baseline my-8">
        <span v-if="is_company" class="mr-2 text-5xl font-extrabold">$199</span>
        <span v-if="!is_company" class="mr-2 text-5xl font-extrabold"
          >$49.99</span
        >
        <span class="text-gray-500 dark:text-gray-400" dark:text-gray-400=""
          >/month</span
        >
      </div>

      <ul role="list" class="mb-8 space-y-4 text-left">
        <li class="flex items-center space-x-3">
          <!-- Icon -->
          <svg
            class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400"
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
          <span>6 mois et 17% de réduction</span>
        </li>
      </ul>

      <a
        v-if="is_company"
        href="https://buy.stripe.com/test_00gg0PcgS042gKseUW"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
         companyHalfYearText
        }}</a
      >
      <a
        v-if="!is_company"
        href="https://buy.stripe.com/test_9AQg0PbcO5omcuc148"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
          freelanceHalfYearText
        }}</a
      >
    </div>
    <!-- Pricing Card -->
    <div
      class="flex flex-col max-w-lg p-6 mx-auto text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white"
    >
      <h3 class="mb-4 text-2xl font-semibold">Yearly</h3>
      <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
        Abonnement annuel avec remise.
      </p>
      <div class="flex items-baseline my-8">
        <span v-if="is_company" class="mr-2 text-5xl font-extrabold">$390</span>
        <span v-if="!is_company" class="mr-2 text-5xl font-extrabold"
          >$99.99</span
        >
        <span class="text-gray-500 dark:text-gray-400">/year</span>
      </div>
      <ul role="list" class="mb-8 space-y-4 text-left">
        <li class="flex items-center space-x-3">
          <!-- Icon -->
          <svg
            class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400"
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
          <span>Abonnement annuel</span>
        </li>
      </ul>
      <a
        v-if="is_company"
        href="https://buy.stripe.com/test_8wM15Vgx818665O001"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
          companyYearText
        }}</a
      >
      <a
        v-if="!is_company"
        href="https://buy.stripe.com/test_bIYcODcgS6sq65OdQV"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-red-900"
        >{{
          freelanceYearText
        }}</a
      >
    </div>
  </section>
</template>

<script>
import { getSubscriptionPlanText } from "../../stores/usersFunction";
export default {
  name: "PricingCard",
  props: {
    is_company: {
      type: Boolean,
      default: false,
    },
    user: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      freelanceMonthText: "",
      freelanceHalfYearText: "",
      freelanceYearText: "",
      companyMonthText: "",
      companyHalfYearText: "",
      companyYearText: "",

    };
  },
  mounted() {
    this.initialize();
  },
  methods: { async initialize() {
    this.freelanceMonthText = await getSubscriptionPlanText(
      this.user,
      "price_1MY3bAAor24Sfpgr1VRs8lgJ"
    );
    this.freelanceHalfYearText = await getSubscriptionPlanText(
      this.user,
      "price_1MY3dMAor24Sfpgr4wlcE2Pp"
    );
    this.freelanceYearText = await getSubscriptionPlanText(this.user, "price_1MY3etAor24SfpgrdS3YtVin")
    
    this.companyMonthText = await getSubscriptionPlanText(
      this.user,
      "price_1MTlBKAor24SfpgrohcSJ6S6"
    );
    this.companyHalfYearText = await getSubscriptionPlanText(
      this.user,
      "price_1MY3RaAor24SfpgrRdc4KpYJ"
    );
    this.companyYearText = await getSubscriptionPlanText(this.user, "price_1MTlclAor24SfpgrZynCfsYo")

  }},
  components: {},
};
</script>
