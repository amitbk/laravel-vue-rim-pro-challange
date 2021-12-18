
export const deleteConfirmModal = (self, deleteAction) => {

    self.$modal.show({
        type: 'danger',
        title: 'Are you sure to delete?',
        body: 'Record will be deleted from database.',
        primary: {
            label: 'Delete',
            theme: 'red',
            action: () => deleteAction(),
        },
        secondary: {
            label: 'Cancel',
            theme: 'white',
            action: () => console.log("Delete action cancelled."),
        },
    })
}