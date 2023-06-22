import { defineStore } from 'pinia';
import { api } from 'src/boot/axios';

// Import: interfaces, notification system and other settings
import { ApiResponseInterface, ApiResponseSingleRecordInterface } from 'src/interfaces/ApiResponseInterface';
import { notificationSystem } from 'src/library/NotificationSystem';

/**
 * Object containing settings for API resources.
 * @type Object.<string, { resource_name: string; resource_endpoint: string }>
 */
const apiSettingsResources: { [key: string]: { resource_name: string; resource_endpoint: string } } = {
  'list-of-equipments': {
    resource_name: 'list-of-equipments',
    resource_endpoint: '/admin/settings/list-of-equipments'
  },
  'equipment-readings': {
    resource_name: 'equipment-readings',
    resource_endpoint: '/admin/settings/equipment-readings'
  },
  'users': {
    resource_name: 'users',
    resource_endpoint: '/admin/settings/users'
  },
  'user-role-types': {
    resource_name: 'user-role-types',
    resource_endpoint: '/admin/settings/user-role-types'
  }
}

const adminSettingsStore = defineStore('adminSettings', {
  state: () => ({
    allRecords: {} as ApiResponseInterface,
    singleRecord: {} as ApiResponseSingleRecordInterface,
    listOfEquipments: {
      equipment_id: {
        key: 'equipment_id',
        name: 'Equipment ID',
        value: '',
        type: 'q-input'
      },
      equipment_description: {
        key: 'equipment_description',
        name: 'Equipment description',
        value: '',
        type: 'q-input'
      },
      equipment_notes: {
        key: 'equipment_notes',
        name: 'Equipment notes',
        value: '',
        type: 'q-input'
      }
    }
  }),
  getters: {
    getAllRecords: (state) => state.allRecords,
    getSingleRecord: (state) => state.singleRecord,
  },
  actions: {
    /**
     * Fetches all records for a given resource name.
     * @param string resourceName - The name of the resource.
     * @returns Promise<void | ApiResponseInterface> -
     * A promise that resolves with the API response or void.
     */
    async fetchAllOrSingleRecords(resourceName: string, recordId?: number): Promise<void | ApiResponseInterface | ApiResponseSingleRecordInterface> {
      if (apiSettingsResources.hasOwnProperty(resourceName)) {
        const selectedResourceEndpoint = apiSettingsResources[resourceName].resource_endpoint;
        const apiEndpoint: string = selectedResourceEndpoint;
        const fullApiUrl: string = recordId ? apiEndpoint + '/' + recordId : apiEndpoint;

        /**
         * Fetches data from the API endpoint.
         * @type ApiResponseInterface | void
         */
        const apiResponse: ApiResponseInterface | ApiResponseSingleRecordInterface | void = await api
          .get(fullApiUrl)
          .then((response) => {
            if (response.data.count === 0) {
              const notificationTitle = 'Warning';
              const notificationMessage = `There are no record(s) to display for this resource: ${resourceName}`;
              notificationSystem(notificationTitle, notificationMessage, 'warning');
            } else {
              if (recordId) {
                this.singleRecord = response.data;
                return this.singleRecord;
              } else {
                this.allRecords = response.data;
                return this.allRecords;
              }
            }
          })
          .catch((error) => {
            console.log(`--> Error response ${resourceName}: `, error.message, error.response?.data);
            console.log(`--> Error request ${resourceName}: `, error.request);
            console.log(`--> Error general ${resourceName}: `, error.message);
            notificationSystem(error.name, error.message, 'negative', error.response.data);
          });

        return apiResponse;
      } else {
        let appendedString = '';
        let isFirst = true;
        // Loop through available resources to create the appended string
        for (const key in apiSettingsResources) {
          if (apiSettingsResources.hasOwnProperty(key)) {
            const resource = apiSettingsResources[key];
            if (isFirst) {
              appendedString += '<b>' + resource.resource_name + '</b>';
              isFirst = false;
            } else {
              appendedString += ', ' + '<b>' + resource.resource_name + '</b>';
            }
          }
        }
        // Display notification for unavailable resource
        const notificationTitle = 'Warning';
        const notificationMessage = `The resource you are requesting: <b>${resourceName}</b> does not exist! <br> Available resources: ${appendedString}`;
        notificationSystem(notificationTitle, notificationMessage, 'warning');
      }
    },

    async createRecord(resourceName: string, payload: object) {
      debugger;
    },

    async downloadRecords(resourceName: string, payload: object) {
      debugger;
    },

    async uploadRecords(resourceName: string, payload: object) {
      debugger;
    },

    async editRecord(resourceName: string, recordId: number, payload: object) {
      debugger;
    },

    async deleteRecord(resourceName: string, recordId: number) {
      debugger;
    }
  },
});

export { adminSettingsStore };
