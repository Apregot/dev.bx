import {Item} from "/homework-7/asset/todo/item.js";

export class List
{
	isProgress;
	loading;
	itemListContainer;
	container;
	items;

	constructor({container})
	{
		this.container = container;
		this.items = [];

		this.itemListContainer = document.createElement('div');
		this.itemListContainer.classList.add('calendar-items');

		this.loading = document.createElement('div');
		this.loading.classList.add('hidden');
		this.loading.innerText = 'Loading...';

		this.container.append(this.loading);

		this.container.append(this.itemListContainer);

		this.isProgress = false;
	}

	render()
	{
		this.load().then(({items}) => {
			if (Array.isArray(items))
			{
				items.forEach((itemData) => {
					this.items.push(this.createItem(itemData));
				});
			}
			this.renderItems();
		}).catch((result) => {
			console.error('Error trying to load items: ' + result);
		});

		this.container.append(this.renderActions());

		const addInput = document.createElement('input');
		addInput.classList.add('calendar-new-item-title');
		const addButton = document.createElement('button');
		addButton.innerText = 'Add';
	}

	createItem(itemData)
	{
		itemData.editButtonHandler = this.handleEditButtonClick.bind(this);
		itemData.saveButtonHandler = this.handleSaveButtonClick.bind(this);
		itemData.deleteButtonHandler = this.handleDeleteButtonClick.bind(this);
		return new Item(itemData);
	}


	handleEditButtonClick(item)
	{
		this.renderItems();
		const index = this.items.indexOf(item);
		if(index > -1)
		{
			const itemList = this.container.querySelectorAll('[class="item-container"]');
			itemList[index].replaceWith(this.items[index].renderEdit());
		}
	}

	handleSaveButtonClick(item)
	{
		const index = this.items.indexOf(item);
		if(index < 0)
		{
			return;
		}
		const editInput = this.container.querySelector('[data-role="edit-input"]');
		if (editInput)
		{
			if (editInput.value.length === 0)
			{
				return;
			}
			this.items[index].title = editInput.value;

			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying edit item: ' + error);
			});
		}
	}

	handleDeleteButtonClick(item)
	{
		const index = this.items.indexOf(item);
		if (index > -1)
		{
			this.items.splice(index, 1);
			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying to delete item');
			})
		}
	}

	renderItems()
	{
		this.itemListContainer.innerHTML = '';

		this.items.forEach((item) => {
			this.itemListContainer.append(item.render());
		});
	}

	renderActions()
	{
		const actionsContainer = document.createElement('div');
		const addContainer = document.createElement('div');
		const addInput = document.createElement('input');
		addInput.classList.add('calendar-new-item-title');
		const addButton = document.createElement('button');
		addButton.innerText = 'Add';
		addButton.addEventListener('click', this.handleAddButtonClick.bind(this));

		addContainer.append(addInput);
		addContainer.append(addButton);
		actionsContainer.append(addContainer);

		return actionsContainer;
	}

	handleAddButtonClick()
	{
		const addInput = this.container.querySelector('[class="calendar-new-item-title"]');
		if (addInput)
		{
			if (addInput.value.length === 0)
			{
				return;
			}
			this.items.push(this.createItem({title: addInput.value}));
			addInput.value = '';

			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying save items: ' + error);
			});
		}
	}

	load()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			return fetch(
				'/homework-7/ajax.php?action=load',
				{
					method: "POST",
				}
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress()
			});
		});
	}

	save()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			const data = {
				items: []
			};
			this.items.forEach((item) => {
				data.items.push(item.getData());
			});
			return fetch(
				'/homework-7/ajax.php?action=save',
				{
					method: "POST",
					headers: {
						'Content-Type': 'application/json;charset=utf-8'
					},
					body: JSON.stringify(data)
				}
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress()
			});
		});
	}

	startProgress()
	{
		this.loading.classList.remove('hidden');
		this.isProgress = true;
	}

	stopProgress()
	{
		this.loading.classList.add('hidden');
		this.isProgress = false;
	}
}