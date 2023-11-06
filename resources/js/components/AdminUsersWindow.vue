<template>
    <div class="content">

        <section class="main-header grid">
            <h1>Users</h1>
            <button class="button">
                <i class="fa-solid fa-plus"></i>
                <span>Add new user</span>
            </button>
        </section>

        <section class="table-header grid">
            <div>
                <div class="select">
                    <select>
                        <option>Choose action</option>
                    </select>
                </div>
                <span>Selected 4 of 4 items</span>
            </div>
            <a class="button link">
                <span>Filters</span>
                <i class="fa-solid fa-angle-down"></i>
            </a>
        </section>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>
                            <div class="test"></div>
                            <div class="checkbox">
                                <input type="checkbox" checked />
                                <span class="checkmark minus"></span>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>User</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="selected">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" checked />
                                <span class="checkmark"></span>
                            </div>
                        </td>
                        <td>1</td>
                        <td>sbardwell0</td>
                        <td>Sarajane</td>
                        <td>Bardwell</td>
                        <td>sbardwell0@freewebs.com</td>
                        <td>+62 347 385 6227</td>
                        <td>Pagedangan</td>
                    </tr>
                    <tr class="selected">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" checked />
                                <span class="checkmark"></span>
                            </div>
                        </td>
                        <td>2</td>
                        <td>ptroctor1</td>
                        <td>Pearl</td>
                        <td>Troctor</td>
                        <td>ptroctor1@weebly.com</td>
                        <td>+62 731 635 4272</td>
                        <td>Labuhan Deli</td>
                    </tr>
                    <!-- ... other rows similarly formatted ... -->
                    <tr class="selected">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" checked />
                                <span class="checkmark"></span>
                            </div>
                        </td>
                        <td>3</td>
                        <td>Heck3</td>
                        <td>Guy</td>
                        <td>Sir</td>
                        <td>MrSir3@weebly.com</td>
                        <td>+1 919 623 3472</td>
                        <td>Raleigh, NC</td>
                    </tr>

                    <tr class="selected">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" checked />
                                <span class="checkmark"></span>
                            </div>
                        </td>
                        <td>4</td>
                        <td>iAMDOM</td>
                        <td>Dominique</td>
                        <td>Simmons</td>
                        <td>ptroctor1@weebly.com</td>
                        <td>+1 336 635 8631</td>
                        <td>Greensboro, NC</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <section class="table-footer grid">
            <span>Displaying 1-10 of 4 items</span>
            <div class="paging grid">
                <span>
                    Page
                    <input type="number" value="1"> of 1
                </span>
                <div class="button icon">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="button icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </section>

    </div>
</template>


<script>
export default {
    name: 'adminUsersWindow',
    // script logic here
}
</script>

<style>
.content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 9px;

    .main-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .button {
            display: flex;
            align-items: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;

            i {
                margin-right: 10px;
            }
        }
    }

    .table-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;

        select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .button {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;

            i {
                margin-left: 10px;
            }
        }
    }

    .card {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;

        table {
            width: 100%;
            border-collapse: collapse;

            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }

            th {
                background-color: #f5f5f5;
                font-weight: bold;
                position: relative;

                .test {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    left: 10px;
                    width: 20px;
                    height: 20px;
                    background-color: #007bff;
                }

                .checkbox {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    right: 10px;
                    display: flex;
                    align-items: center;
                    cursor: pointer;

                    input[type="checkbox"] {
                        display: none;
                    }

                    .checkmark {
                        width: 20px;
                        height: 20px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-right: 5px;

                        &.minus {
                            background-color: #f5f5f5;
                            color: #ccc;
                        }
                    }

                    input[type="checkbox"]:checked+.checkmark {
                        background-color: #007bff;
                        color: #fff;
                        border-color: #007bff;
                    }
                }
            }

            tr.selected {
                background-color: #f5f5f5;
            }

            tbody tr:hover {
                background-color: #f5f5f5;
            }
        }
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;

        span {
            font-size: 14px;
            color: #333;
        }

        .paging {
            display: flex;
            align-items: center;

            input[type="number"] {
                width: 50px;
                margin: 0 5px;
                text-align: center;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 5px;
            }

            .button {
                display: flex;
                align-items: center;
                background-color: #f5f5f5;
                color: #333;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;

                i {
                    margin: 0;
                }
            }
        }
    }
}
</style>
