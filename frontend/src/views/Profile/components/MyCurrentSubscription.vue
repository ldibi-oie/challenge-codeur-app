<template>
  <div style="max-width: 950px;" class="container pt-8  flex flex-col items-center pb-40">
      <div class="flex flex-row w-full">

        <div class="w-full bg-white shadow">
          <div class="w-full flex flex-col items-start" v-if="this.subscription">
            <div class="flex flex-row items-center justify-between px-4 py-2 bg-gray-100 w-full">
              <p class="text-lg font-bold">Subscription</p>
            </div>
            <div class="flex flex-col items-start justify-between px-4 py-2 w-full">
                
                <div class="flex flex-row items-center mb-4 mt-6">
                 <p class="text-sm font-medium mr-4">Subscription type: </p>
                <p class="text-xs font-medium">Basic</p>
              </div>

              <div class="flex flex-row items-center mb-4">
                <p class="text-sm font-medium mr-4">Subscription name: </p>
                <p class="text-xs font-medium ">{{ subscription.plan.name}}</p>
              </div>

              <div class="flex flex-row items-center mb-4">
                <p class="text-sm font-medium mr-4">Subscription price: </p>
                <p class="text-xs font-medium">{{ subscription.plan.price / 100 }} €</p>
              </div>

              <div class="flex flex-row items-center mb-4">
                <p class="text-sm font-medium mr-4">Subscription date: </p>
                <p class="text-xs font-medium">{{ moment(subscription.currentPeriodStart).format('lll') }} </p>
              </div>

              <div class="flex flex-row items-center mb-4">
                <p class="text-sm font-medium mr-4">Subscription end date: </p>
                <p class="text-xs font-medium">{{ moment(subscription.currentPeriodEnd).format('lll') }} </p>
              </div>

              <div class="flex flex-row  justify-end  my-4 w-full">
                 <button  @click="changePlan()"  class="rounded-lg shadow text-xs py-2 px-8 bg-green-300  flex items-center">Change Plan</button>
               </div>

            </div>
    
          </div>
          <div v-if="loading" class="flex flex-col items-center shadow-md p-4 mb-8 bg-white" style="min-height: 250px;">
            <div
              class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200">
              loading...
            </div>
          </div>
        </div>


        <div style="min-width: 250px;" >
          <div class="flex flex-col shadow ml-4 bg-white">
            <div class="w-full">
                <div class="flex flex-row items-center justify-between px-4 py-2 bg-gray-100">
                    <p class="text-lg font-bold">Invoices</p>
                </div>
                <div v-if="invoices?.length > 0" class="flex flex-col">
                    <div v-for="invoice in invoices" :key="invoice.id" class="flex flex-row items-center justify-between px-4 py-2">
                        <div class="flex flex-row items-center w-full">
                            <a class="text-xs font-medium truncate ... flex-wrap text-blue-400" :href="invoice.hostedInvoiceUrl">{{ invoice.hostedInvoiceUrl}}</a>
                        </div>
                    </div>
            </div>

            <div>
              <div v-if="candidates?.length === 0" class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex flex-row items-center">
                  <p>No Invoices yet</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
</div>
</template>

<script>
import moment from 'moment';
import { getActiveSubscription, getInvoicesBySubscriptionId, getLoggedUser } from '../../../stores/usersFunction';

export default {
    name: "MyCurrentSubscription",
    data() {
        return {
           subscription: null,
           invoices: null
        };
    },
    async mounted() {
        //this.loading = true;
        // get the active subscription
        this.user = await getLoggedUser();
        console.log("this.user", this.user);
        this.subscription = await getActiveSubscription(this.user);
        console.log("this.subscription", this.subscription);
        if (this.subscription) {
            this.invoices = await getInvoicesBySubscriptionId({
                subscription_id: this.subscription.id,
            });
            console.log("this.invoices", this.invoices);
        }
    },
    methods: {
        changePlan() {
            this.$router.push({ name: "subscription"});
        },
        moment,
    },
}
</script>