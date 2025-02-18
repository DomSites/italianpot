/* Creates A Store For Risk Data using Zustand */
import {create} from 'zustand';
import * as rsssl_api from "../../utils/api";
import {produce} from "immer";
import apiFetch from "@wordpress/api-fetch";

const DynamicDataTableStore = create((set, get) => ({
    processing: false,
    dataLoaded: false,
    pagination: {},
    dataActions: {currentPage:1, currentRowsPerPage:5, filterValue: 'all',filterColumn: 'rsssl_two_fa_status'},
    totalRecords:0,
    DynamicDataTable: [],

    setDataLoaded: (dataLoaded) => set((state) => ({ ...state, dataLoaded: dataLoaded })),
    resetUserMethod: async (id, optionalRoles, currentRole) => {
        if (get().processing) {
            return;
        }
        if ( optionalRoles.includes(currentRole) ) {
            set({processing: true});
            set({dataLoaded: false});
            const response = await apiFetch({
                path: `/wp/v2/users/${id}`,
                method: 'POST',
                data: {
                    meta: {
                        rsssl_two_fa_status_email: 'open',
                        rsssl_two_fa_status_totp: 'open',
                    },
                    _wpnonce: rsssl_settings.nonce,
                },
            }).catch((error) => {
                console.error(error);
            });
            set({processing: false});
            set({dataLoaded: true});
        }
    },
    hardResetUser: async (id) => {
        if (get().processing) return;
        set({processing: true});
        try {
            const response = await rsssl_api.doAction(
                'two_fa_reset_user',
                {id}
            );
            if (response) {
                set(state => ({
                    ...state,
                    processing: false,
                }));
                // Return the response for the calling function to use
                return response;
            }
        } catch (e) {
            console.log(e);
        }
    },
    fetchDynamicData: async () => {
        if (get().processing) return;
        set({processing: true});
        try {
            const response = await rsssl_api.doAction(
                'two_fa_table',
                get().dataActions
            );
            if (response && response.data) {
                set(state => ({
                    ...state,
                    DynamicDataTable: response.data,
                    dataLoaded: true,
                    processing: false,
                    pagination: response.pagination,
                    totalRecords: response.totalRecords,
                }));
                // Return the response for the calling function to use
                return response;
            } else {
                set(state => ({
                    ...state,
                    processing: false,
                    dataLoaded: true,
                }));
            }
        } catch (e) {
            console.log(e);
        }
    },

    handleTableSearch: async (search, searchColumns) => {
        const typingTimer = setTimeout(async () => {
            set(produce((state) => {
                state.dataActions = {...state.dataActions, search, searchColumns};
            }));
            await get().fetchDynamicData();
        }, 500);

        return () => {
            clearTimeout(typingTimer);
        };
    },

    handlePageChange: async (page, pageSize) => {
        //Add the page and pageSize to the dataActions
        set(produce((state) => {
                state.dataActions = {...state.dataActions, currentPage: page};
            })
        );
        await get().fetchDynamicData();
    },

    handleRowsPerPageChange: async (currentRowsPerPage, currentPage) => {
        //Add the page and pageSize to the dataActions
        set(produce((state) => {
                state.dataActions = {...state.dataActions, currentRowsPerPage, currentPage};
            })
        );
        await get().fetchDynamicData();
    },

    //this handles all pagination and sorting
    handleTableSort: async (sortColumn, sortDirection) => {
        //Add the column and sortDirection to the dataActions
        set(produce((state) => {
                state.dataActions = {...state.dataActions, sortColumn: sortColumn.column, sortDirection};
            })
        );
        await get().fetchDynamicData();
    },

    handleUsersTableFilter: async (column, filterValue) => {
        //Add the column and sortDirection to the dataActions
        set(produce((state) => {
                state.dataActions = {...state.dataActions, filterColumn: column, filterValue};
            })
        );
        // Fetch the data again
        await get().fetchDynamicData();
    },

}));

export default DynamicDataTableStore;