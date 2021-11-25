export class Item
{
	title;
	deleteButtonHandler;
	editButtonHandler;
	saveButtonHandler;

	constructor({title, saveButtonHandler,editButtonHandler,deleteButtonHandler})
	{
		this.title = String(title);
		if (typeof saveButtonHandler === 'function')
		{
			this.saveButtonHandler = saveButtonHandler;
		}
		if (typeof editButtonHandler === 'function')
		{
			this.editButtonHandler = editButtonHandler;
		}
		if (typeof deleteButtonHandler === 'function')
		{
			this.deleteButtonHandler = deleteButtonHandler;
		}

	}

	getData()
	{
		return {title: this.title};
	}

	render()
	{
		const container = document.createElement('div');
		container.classList.add('item-container');
		const title = document.createElement('div');
		title.classList.add('item-title');
		title.innerText = this.title;
		container.append(title);
		const buttonsContainer = document.createElement('div');
		const deleteButton = document.createElement('button');
		deleteButton.innerText = 'Delete';
		const editButton = document.createElement('button')
		editButton.innerText = 'Edit';
		editButton.setAttribute('data-role', 'edit-button');

		buttonsContainer.append(editButton);
		buttonsContainer.append(deleteButton);
		editButton.addEventListener('click', this.handleEditButtonClick.bind(this));
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));

		container.append(buttonsContainer);
		return container;
	}

	renderEdit()
	{
		const container = document.createElement('div');
		container.classList.add('item-container');
		const inputItem = document.createElement('input');
		inputItem.value = this.title;
		inputItem.setAttribute('data-role', 'edit-input');
		container.append(inputItem);

		const buttonsContainer = document.createElement('div');
		const saveButton = document.createElement('button');
		saveButton.setAttribute('data-role', 'save-button');
		saveButton.innerText = 'Save';
		const deleteButton = document.createElement('button');
		deleteButton.innerText = 'Delete';

		buttonsContainer.append(saveButton);
		buttonsContainer.append(deleteButton);
		saveButton.addEventListener('click', this.handleSaveButtonClick.bind(this));
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));
		container.append(buttonsContainer);
		return container;
	}


	handleSaveButtonClick()
	{
		if (this.saveButtonHandler)
		{
			this.saveButtonHandler(this);
		}
	}

	handleEditButtonClick()
	{
		if (this.editButtonHandler)
		{
			this.editButtonHandler(this);
		}
	}

	handleDeleteButtonClick()
	{
		if (this.deleteButtonHandler)
		{
			this.deleteButtonHandler(this);
		}
	}
}